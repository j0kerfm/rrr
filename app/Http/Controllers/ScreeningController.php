<?php

namespace App\Http\Controllers;

use App\Models\Halls;
use App\Models\Movies;
use App\Models\Screenings;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Middleware;

#[Middleware('auth')]
#[Middleware('role:admin')]
class ScreeningController extends Controller
{
    public function index()
    {
        $halls = Halls::orderBy('name')->get();
        $screenings = Screenings::with(['movie', 'hall'])
            ->orderBy('start_time', 'desc')
            ->paginate(20);
        return view('admin.screenings', compact('screenings', 'halls'));
    }

    public function form(Request $request, Screenings $screening = null)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'movie_id'   => 'required|exists:movies,id',
                'hall_id'    => 'required|exists:halls,id',
                'start_time' => 'required|date|after:now',
                'format'     => 'required|in:2D,3D,IMAX,VIP',
                'ticket_price'      => 'required|numeric|min:0',
            ];
            $data = $request->validate($rules);

            $movie = Movies::findOrFail($data['movie_id']);
            $start = \Carbon\Carbon::parse($data['start_time']);
            $end   = $start->copy()->addMinutes($movie->duration);

            $conflict = Screenings::where('hall_id', $data['hall_id'])
                ->when($screening, fn($q) => $q->where('id', '!=', $screening->id))
                ->where(function ($q) use ($start, $end) {
                    $q->where('start_time', '<', $end)
                      ->whereRaw('DATE_ADD(start_time, INTERVAL (SELECT duration FROM movies WHERE movies.id = screenings.movie_id) MINUTE) > ?', [$start]);
                })
                ->exists();

            if ($conflict) {
                return back()->withInput()->withErrors([
                    'start_time' => 'В этом зале уже есть сеанс, пересекающийся по времени.',
                ]);
            }

            if ($screening) {
                $screening->update($data);
                $msg = 'Сеанс обновлён';
            } else {
                Screenings::create($data);
                $msg = 'Сеанс добавлен';
            }

            return redirect()->route('admin.screenings')->with('success', $msg);
        }

        $movies = Movies::orderBy('title')->get();
        $halls  = Halls::orderBy('name')->get();
        return view('admin.screeningForm', compact('screening', 'movies', 'halls'));
    }

    public function destroy(Screenings $screening)
    {
        if ($screening->tickets()->exists()) {
            return back()->with('error', 'Нельзя удалить сеанс, на который проданы билеты.');
        }
        $screening->delete();
        return back()->with('success', 'Сеанс удалён');
    }
}
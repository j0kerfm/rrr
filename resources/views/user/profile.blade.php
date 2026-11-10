@extends('layout.index')

@section('title', 'Мои билеты')
@section('content')
<div class="container">
    <h2 class="page-title mb-4">Мои билеты</h2>
    @if($active->isEmpty())
        <div class="alert alert-info"><i class="bi-ticket me-1"></i> Пока нет купленных билетов.</div>
    @else
        <div class="row g-3">
            @foreach($active as $ticket)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-left:4px solid var(--cine-accent);">
                        <div class="card-body">
                            <h5 class="mb-2">{{ $ticket->screening->movie->title }}</h5>
                            <div class="small mb-3" style="color:#8b90a0;">
                                <div><i class="bi-calendar-event me-1"></i> {{ $ticket->screening->start_time->format('d.m.Y H:i') }}</div>
                                <div><i class="bi-building me-1"></i> Зал {{ $ticket->screening->hall->name }}</div>
                                <div><i class="bi-geo-alt me-1"></i> Место {{ $ticket->row }}-{{ $ticket->seat }}</div>
                            </div>
                            <a href="{{ route('user.ticket', $ticket) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi-qr-code me-1"></i> QR-код
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
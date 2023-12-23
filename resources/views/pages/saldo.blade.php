@extends('pages.app')
@section('content')
<div class="container saldo-user">
    <h1 class="mb-3">Keuangan</h1>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Saldo Saya</h5>
                    <p>Status: <span class="badge text-bg-warning">{{$user->status_penarikan_saldo}}</span></p>
                    <p class="card-text">{{ $saldo }}</p>
                    @if ($user->status_penarikan_saldo == 'diproses')
                    <button class="btn btn-primary" disabled>Tarik Saldo</button>
                    @elseif ($user->bank && $user->no_rekening)
                    <form action="/user/saldo/{{$user->id}}/request-penarikan" method="post">
                        @csrf
                        @method('put')
                        <button class="btn btn-primary" type="submit">Tarik Saldo</button>
                    </form>
                    @else
                    <button class="btn btn-primary" disabled>Tarik Saldo</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Rekening Saya</h5>
                    <p class="card-text">{{ $user->bank ?? 'Belum ditambahkan' }}</p>
                    <p class="card-text">{{ $user->no_rekening ?? 'Belum ditambahkan' }}</p>
                    @if (!$user->bank || !$user->no_rekening)
                    <form action="/user/saldo/baru" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" class="form-control" id="bank" name="bank">
                        </div>
                        <div class="mb-3">
                            <label for="no_rekening" class="form-label">Nomor Rekening</label>
                            <input type="number" class="form-control" id="no_rekening" name="no_rekening">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan Rekening</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
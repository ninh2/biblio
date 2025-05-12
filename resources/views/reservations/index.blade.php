@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Mes Réservations</h1>

        @if (session('user') && session('user')['role'] === 'gestionnaire')
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">Ajouter une réservation</a>
        @else
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">Réserver</a>
        @endif

        <div class="table-responsive">
            @if (session('user') && session('user')['role'] === 'gestionnaire')
                <!-- Tableau pour les gestionnaires -->
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Ouvrage</th>
                            <th scope="col">Date de Réservation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->ouvrage ? $reservation->ouvrage->titre : 'Aucun ouvrage' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('reservations.edit', $reservation->id_reservation) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('reservations.destroy', $reservation->id_reservation) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Aucune réservation trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <!-- Tableau pour les non-gestionnaires -->
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Ouvrage</th>
                            <th scope="col">Date de Réservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->ouvrage ? $reservation->ouvrage->titre : 'Aucun ouvrage' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Aucune réservation trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
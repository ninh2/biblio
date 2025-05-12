@extends('layouts.app')

@section('title', 'Liste des éditeurs')

@section('content')
<h1 style="display: flex; align-items: center; justify-content: center;">Liste des éditeurs</h1>

<div style="display: flex; align-items: center; justify-content: center;">
    <input type="text" id="search" placeholder="Rechercher un éditeur">
    <a href="{{ route('editeurs.create') }}" class="btn btn-primary">Ajouter un éditeur</a>
</div>

<div style="display: flex; align-items: center; justify-content: center;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libelle</th>
                <th>Gérer</th>
            </tr>
        </thead>
        <tbody id="editeurs-table">
            @foreach($editeurs as $editeur)
                <tr>
                    <td>{{ $editeur->id_editeur }}</td>
                    <td>{{ $editeur->libelle }}</td>
                    <td>
                        <a href="{{ route('editeurs.edit', $editeur->id_editeur) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('editeurs.destroy', $editeur->id_editeur) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet éditeur ?')" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var search = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route("editeurs.search") }}',
                data: {search: search},
                success: function(data) {
                    $('#editeurs-table').html(data);
                }
            });
        });
    });
</script>
@endsection
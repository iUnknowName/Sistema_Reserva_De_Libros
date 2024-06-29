<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Cuenta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p>Nombre: {{ $user->name }}</p>
                    <p>Total de reservas activas: {{ $reservations->count() }}</p>

                    <h2>Mis Reservas Activas</h2>
                    @if($reservations->isEmpty())
                        <p>No tienes reservas activas.</p>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Libro</th>
                                    <th class="px-4 py-2">Fecha de Reserva</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $reservation->book->title }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->created_at->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

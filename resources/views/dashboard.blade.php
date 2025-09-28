<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Você está logado!") }}
                </div>
            </div>

            {{-- INÍCIO DA AGENDA DO DIA --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                        Agenda de Hoje ({{ \Carbon\Carbon::today()->format('d/m/Y') }})
                    </h3>

                    <ul class="divide-y divide-gray-200">
                        @forelse ($todayAppointments as $appointment)
                            <li class="py-4 flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        <span class="font-bold">{{ $appointment->start_time->format('H:i') }}</span> -
                                        Cliente: {{ $appointment->client->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Barbeiro: {{ $appointment->user->name }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="py-4">
                                <p class="text-center text-gray-500">Nenhum agendamento para hoje.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- FIM DA AGENDA DO DIA --}}

        </div>
    </div>
</x-app-layout>
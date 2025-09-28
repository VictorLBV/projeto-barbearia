<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['client', 'user'])->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $employees = User::orderBy('name')->get();
        return view('appointments.create', compact('clients', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'notes' => 'nullable|string',
        ])

        $data = $request->all();
        $data['end_time'] = Carbon::parse($data['start_time'])->addHour();

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Agendamento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $clients = Client::orderBy('name')->get();
        $employees = User::orderBy('name')->get();
        return view('appointments.edit', compact('appointment', 'clients', 'employees'));
    }
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['end_time'] = Carbon::parse($data['start_time'])->addHour();

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Agendamento deletado com sucesso!');
    }

    public function dashboard()
    {
        $todayAppointments = Appointment::with(['client', 'user'])
            ->whereDate('start_time', Carbon::today())
            ->orderBy('start_time', 'asc')
            ->get()
        return view('dashboard', compact('todayAppointments'));
    }

}

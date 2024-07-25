<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketAdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('admin.ticket.app', compact('tickets'));
    }

    public function openTicket($ticket_id)
    {
        DB::beginTransaction();
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->status_id = 1;
            $ticket->save();
            DB::commit();
            $tickets = Ticket::paginate(10);
            return view('admin.ticket.app', compact('tickets'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function solveTicket($ticket_id)
    {
        DB::beginTransaction();
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->status_id = 2;
            $ticket->save();
            DB::commit();
            return view('admin.ticket.open.app', compact('ticket'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function closeTicket($ticket_id)
    {
        DB::beginTransaction();
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->status_id = 3;
            $ticket->save();
            DB::commit();
            return view('admin.ticket.open.app', compact('ticket'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->delete();
            return back()->with('success', 'Ticket deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}

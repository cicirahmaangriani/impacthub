<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->middleware('auth');
    }

    /**
     * Display the specified transaction
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        $transaction->load(['registration.event']);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $validated = $request->validate([
            'payment_method' => 'required|in:dana,ovo,gopay,bank_transfer,credit_card',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        // Handle payment proof upload
        if ($request->hasFile('payment_proof')) {
            $validated['payment_proof'] = $request->file('payment_proof')
                ->store('payment-proofs', 'public');
        }

        try {
            // TODO: Integrate with actual payment gateway
            // For now, we'll mark as paid immediately for testing
            
            $this->transactionService->processPayment($transaction, [
                'payment_method' => $validated['payment_method'],
                'response' => ['status' => 'success', 'test_mode' => true],
            ]);

            return redirect()->route('registrations.show', $transaction->registration)
                ->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

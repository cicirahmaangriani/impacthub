<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration;
use App\Services\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    protected $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    /**
     * Display user's certificates
     */
    public function index()
    {
        $certificates = auth()->user()
            ->certificates()
            ->with('event')
            ->latest()
            ->paginate(12);

        return view('certificates.index', compact('certificates'));
    }

    /**
     * Generate certificate
     */
    public function generate(Registration $registration)
    {
        $this->authorize('view', $registration);

        try {
            $certificate = $this->certificateService->generateCertificate($registration);

            return redirect()->route('certificates.show', $certificate)
                ->with('success', 'Certificate generated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified certificate
     */
    public function show(Certificate $certificate)
    {
        $certificate->load(['user', 'event']);

        return view('certificates.show', compact('certificate'));
    }

    /**
     * Download certificate
     */
    public function download(Certificate $certificate)
    {
        $this->authorize('view', $certificate);

        // TODO: Return actual PDF download
        return response()->download(
            storage_path('app/' . $certificate->certificate_url),
            "certificate-{$certificate->certificate_code}.pdf"
        );
    }

    /**
     * Verify certificate
     */
    public function verify(Request $request)
    {
        $request->validate([
            'certificate_code' => 'required|string',
        ]);

        try {
            $certificate = $this->certificateService->verifyCertificate(
                $request->certificate_code
            );

            return view('certificates.verify', compact('certificate'));
        } catch (\Exception $e) {
            return back()->with('error', 'Certificate not found or invalid.');
        }
    }
}

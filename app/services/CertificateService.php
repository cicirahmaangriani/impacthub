<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;

class CertificateService
{
    public function generateCertificate(Registration $registration)
    {
        // Check if event has certificate available
        if (!$registration->event->certificate_available) {
            throw new \Exception('Certificate is not available for this event');
        }
        
        // Check if registration is confirmed
        if ($registration->status !== 'confirmed') {
            throw new \Exception('Registration must be confirmed to generate certificate');
        }
        
        // Check if certificate already exists
        if ($registration->certificate) {
            return $registration->certificate;
        }
        
        // Check if event has ended
        if (now()->lt($registration->event->end_date)) {
            throw new \Exception('Certificate can only be generated after event ends');
        }
        
        $certificate = Certificate::create([
            'user_id' => $registration->user_id,
            'event_id' => $registration->event_id,
            'registration_id' => $registration->id,
            'certificate_code' => Certificate::generateCertificateCode(),
            'issued_at' => now(),
        ]);
        
        // Generate PDF certificate
        $pdfPath = $this->generatePDF($certificate);
        $certificate->update(['certificate_url' => $pdfPath]);
        
        // TODO: Send certificate notification
        
        return $certificate;
    }
    
    protected function generatePDF(Certificate $certificate)
    {
        // TODO: Implement PDF generation using DomPDF or similar
        // This is a placeholder
        
        $filename = "certificate-{$certificate->certificate_code}.pdf";
        $path = "certificates/{$filename}";
        
        // Placeholder: Store certificate info as JSON for now
        Storage::put($path, json_encode([
            'code' => $certificate->certificate_code,
            'user' => $certificate->user->name,
            'event' => $certificate->event->title,
            'issued_at' => $certificate->issued_at,
        ]));
        
        return $path;
    }
    
    public function verifyCertificate(string $code)
    {
        return Certificate::with(['user', 'event'])
            ->where('certificate_code', $code)
            ->firstOrFail();
    }
}
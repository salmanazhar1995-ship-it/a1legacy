<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportIndustriesRequest;
use App\Services\IndustryCsvImporter;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndustryImportController extends Controller
{
    public function store(ImportIndustriesRequest $request, IndustryCsvImporter $importer): RedirectResponse
    {
        $count = $importer->import($request->file('import_file'));

        return redirect()->route('admin.industries.index')->with('success', "{$count} sub industries imported successfully.");
    }

    public function template(): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            // UTF-8 BOM keeps the template friendly for Excel while the importer safely strips it.
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, IndustryCsvImporter::HEADERS);

            $examples = [
                [
                    'Insurance', 'insurance', 'AI and automation solutions for insurance teams.', '10',
                    'Claims Operations', 'claims-operations', 'Agencies & Brokerages',
                    'Automate claims intake, routing and customer updates.',
                    '24/7 enquiry capture|Claims routing|Customer follow-up',
                    'Works with your approved CRM and claims systems.', 'Explore Insurance', '/industries/claims-operations', '1', '10',
                ],
                [
                    'Insurance', 'insurance', 'AI and automation solutions for insurance teams.', '10',
                    'Policy Servicing', 'policy-servicing', 'Carriers & MGAs',
                    'Handle policy questions, service requests and renewal follow-up with structured AI workflows.',
                    'Policy enquiries|Renewal follow-up|Service request routing',
                    'Keep regulated decisions and approvals with your authorised team.', 'View Policy Servicing', '/industries/policy-servicing', '1', '20',
                ],
                [
                    'Healthcare', 'healthcare', 'AI-enabled patient communication and workflow automation for healthcare organisations.', '20',
                    'Patient Scheduling', 'patient-scheduling', 'Clinics & Practices',
                    'Capture patient enquiries and coordinate appointment requests across phone, web and CRM workflows.',
                    'Appointment requests|Missed-call follow-up|FAQ handling',
                    'Use only approved messaging and connected systems.', 'View Patient Scheduling', '/industries/patient-scheduling', '1', '10',
                ],
            ];

            foreach ($examples as $example) {
                fputcsv($output, $example);
            }
            fclose($output);
        }, 'industries-import-template.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}

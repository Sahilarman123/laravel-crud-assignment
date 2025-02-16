<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Services\ContactService;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ImportXMLRequest;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAllContacts();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(ContactRequest $request)
    {
        $this->contactService->createContact($request->validated());
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function edit($id)
    {
        $contact = $this->contactService->getContactById($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, $id)
    {
        $this->contactService->updateContact($id, $request->validated());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function importXML(ImportXMLRequest $request)
    {
        try {
            $this->contactService->importContactsFromXML($request->file('xml_file'));
            return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully.');
        } catch (\Exception $e) {
            Log::error('XML Import Error: ' . $e->getMessage());
            return redirect()->route('contacts.index')->with('error', 'Failed to import contacts.');
        }
    }
}


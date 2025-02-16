<?php

namespace App\Services;

use App\Models\Contact;
use SimpleXMLElement;
use Illuminate\Http\UploadedFile;

class ContactService
{
    public function getAllContacts()
    {
        return Contact::all();
    }

    public function getContactById($id)
    {
        return Contact::findOrFail($id);
    }

    public function createContact(array $data)
    {
        return Contact::create($data);
    }

    public function updateContact($id, array $data)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($data);
        return $contact;
    }

    public function deleteContact($id)
    {
        Contact::destroy($id);
    }

    public function importContactsFromXML(UploadedFile $file)
    {
        $xmlData = file_get_contents($file);
        $xml = new SimpleXMLElement($xmlData);

        foreach ($xml->contact as $contact) {
            Contact::updateOrCreate(
                ['phone' => (string)$contact->phone],
                [
                    'name' => (string)$contact->name,
                    'last_name' => (string)$contact->lastName,
                ]
            );
        }
    }
}

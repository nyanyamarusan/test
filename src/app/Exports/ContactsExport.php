<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return Contact::with('category')
            ->KeywordSearch($this->request->keyword)
            ->GenderSearch($this->request->gender)
            ->CategorySearch($this->request->category_id)
            ->DateSearch($this->request->date)
            ->get();
    }

    public function headings(): array
    {
        return [
            '名前',
            '性別',
            'メールアドレス',
            'お問い合わせの種類',
        ];
    }

    public function map($contact): array
    {
        return [
            $contact->name,
            $contact->gender,
            $contact->email,
            $contact->category ? $contact->category->content : '',
        ];
    }
}

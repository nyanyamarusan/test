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

    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

    public function collection()
    {
        return $this->contacts;
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
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return [
            $contact->last_name . ' ' . $contact->first_name,
            $genderLabels[$contact->gender] ?? '不明',
            $contact->email,
            $contact->category ? $contact->category->content : '未分類',
        ];
    }
}
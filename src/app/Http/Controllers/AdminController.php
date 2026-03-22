<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')
            ->search($request)
            ->paginate(7)
            ->appends($request->all());
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $query = Contact::with('category')->search($request);

        $contacts = $query->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせ種類',
                'お問い合わせ内容',
                '日付'
            ]);
            foreach ($contacts as $contact) {
                $gender = match($contact->gender) {
                    1 => '男性',
                    2 => '女性',
                    default => 'その他'
                };
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at->format('Y-m-d')
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="contacts.csv"'
        );

        return $response;
    }
}

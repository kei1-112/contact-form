<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    //お問い合わせ作成画面の呼び出し
    public  function index(){
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    //確認画面の呼び出し
    public function confirm(ContactRequest $request){
        $contact = $request->only(['first_name', 'last_name','gender', 'email','tel1', 'tel2','tel3', 'address','building', 'category_id','detail']);
        $categories = Category::all();
        return view('confirm', compact('contact'), compact('categories'));
    }

    //確認画面から入力画面に戻るためのアクション
    public function edit(Request $request)
    {
        return redirect('/')
            ->withInput($request->all());
    }
    //DBにお問い合わせ内容を登録する
    public function store(Request $request){
        $contact = $request->only(['first_name', 'last_name','gender', 'email','tel', 'address','building', 'category_id','detail']);
        Contact::create($contact);
        return redirect('/thanks');
    }

    //管理画面でお問い合わせ一覧を表示する
    public function admin(){
        $contacts = Contact::Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    //管理画面で検索結果を表示する
    public function search(Request $request){
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->orWhere('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('gender') && $request->gender!= 0) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->appends($request->all());
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    //CSVでデータをエクスポートする
    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->orWhere('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('gender') && $request->gender != 0) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $columns = ['ID', '姓', '名', '性別', 'メール', '電話番号', '住所', '建物名', 'お問合せの種類', 'お問合せ内容'];

        $callback = function () use ($contacts, $columns) {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, $columns);

            foreach ($contacts as $contact) {
                if ($contact->gender == 1) {
                    $genderLabel = '男性';
                } elseif ($contact->gender == 2) {
                    $genderLabel = '女性';
                } elseif ($contact->gender == 3) {
                    $genderLabel = 'その他';
                } else {
                    $genderLabel = '未設定';
                }

                fputcsv($file, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $genderLabel,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    //サンクスページの呼び出し
    public function thanks(){
        return view('thanks');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.add');
    }

    public function save(Request $request)
    {
         DB::table('customers')->insert([
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'email' => $request->email
        ]);
    // alihkan halaman ke halaman pegawai
    return redirect('/customer');
 
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|string|exists:customers,email'
        ]);

        try {
            $customer = Customer::find($id);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            return redirect('/customer')->with(['success' => 'Data telah diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with(['success' => '<strong>' . $customer->name . '</strong> Telah dihapus']);
    }
}

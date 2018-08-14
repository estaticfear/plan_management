<?php

namespace IXOSoftware\PlanManagement\Controllers;

use App\Http\Controllers\Controller;
use IXOSoftware\PlanManagement\Models\Plan;
use IXOSoftware\PlanManagement\Models\PlanOption;
use Illuminate\Http\Request;
use DataTables;

class PlanController extends Controller
{
    public function index()
    {
        return view('laravel-plan-management::plans.index');
    }

    public function anyData()
    {
        return DataTables::of(Plan::query())
            ->addColumn('action', function ($plan) {
                return '
                    <div class="btn-group">
                        <a href="plans/' . $plan->id . '" class="btn btn-sm btn-info">View</a>
                        <a href="plans/' . $plan->id . '/edit" class="btn btn-sm btn-primary">Edit</a>
                        <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger delete-item" data-id="' . $plan->id . '"
                             data-url="' . route('plans.destroy', $plan->id) . '">Delete</a>
                    </div>
                ';
            })
            ->make(true);
    }

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        $planOptions = $plan->options()->orderBy('position', 'asc')->get()->toArray();
        return view('laravel-plan-management::plans.show', compact('plan', 'planOptions'));
    }

    public function create()
    {
        return view('laravel-plan-management::plans.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'call_minutes' => 'required|alpha_num',
        ]);
        $data = $request->except('_token', 'option');
        if ($plan = Plan::create($data)) {
            $data = $request->except('_token');
            if (!empty($data['option'])) {
                $options = $data['option'];
                $values = $options['value'];
                $positions = $options['position'];
                $status = $options['is_active'];
                foreach ($values as $key => $value) {
                    if (!empty($value)) {
                        $planOption = new PlanOption;
                        $planOption->plan_id = $plan->id;
                        $planOption->value = $value;
                        $planOption->position = (!empty($positions[$key])) ? $positions[$key] : 0;
                        $planOption->is_active = (!empty($status[$key])) ? $status[$key] : 0;
                        $planOption->save();
                    }
                }
            }
            return redirect()->route('plans.index')->with('f_success', 'Plan created successfully');
        }
        else return redirect()->route('products.index')->with('f_error', 'Error, please try again');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $planOptions = $plan->options()->orderBy('position', 'asc')->get()->toArray();
        return view('laravel-plan-management::plans.edit', compact('plan', 'planOptions'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'call_minutes' => 'required|alpha_num',
        ]);
        $data = $request->except('_token', 'option');
        $plan = Plan::findOrFail($id);
        if ($plan->update($data)) {
            $data = $request->except('_token');
            $plan->options()->delete();
            if (!empty($data['option'])) {
                $options = $data['option'];
                $values = $options['value'];
                $positions = $options['position'];
                $status = $options['is_active'];
                foreach ($values as $key => $value) {
                    if (!empty($value)) {
                        $planOption = new PlanOption;
                        $planOption->plan_id = $plan->id;
                        $planOption->value = $value;
                        $planOption->position = (!empty($positions[$key])) ? $positions[$key] : 0;
                        $planOption->is_active = (!empty($status[$key])) ? $status[$key] : 0;
                        $planOption->save();
                    }
                }
            }
            return redirect()->route('plans.index')->with('f_success', 'Plan created successfully');
        }
        else return redirect()->route('products.index')->with('f_error', 'Error, please try again');
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        if ($plan->delete()) {
            $plan->options()->delete();
            return response()->json(array(
                'message' => 'Plan has been deleted successfully',
            ));
        } else {
            return response()->json(array(
                'message' => 'Error, please try again',
            ));
        }
    }
}


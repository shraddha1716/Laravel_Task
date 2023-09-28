<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\Classe; 
use App\Models\Teacher; 
class FormController extends Controller
{
    public function index()
    {
        $class= Classe::all();
        $teacher= Teacher::all();
        $student = Student::with('class_relation','teacher_relation')->get();
        return view('tab',compact('class','teacher','student'));

    }

    public function storeData(Request $request)
    {  
       $active_tab=  $request->input('active_tab');
        switch ($active_tab) {
            case 'student': // Student tab
                $this->validate($request, [
                    'sname' => 'required|string|max:255',
                    'semail' => 'required|email',
                    'saddress' => 'required|string',
                    'sclass' => 'required|integer',
                    'steacher' => 'required|integer',
                    'scast' => 'nullable', 
                ]);

                $student = new Student;
                $student->name = $request->input('sname');
                $student->email = $request->input('semail');
                $student->address = $request->input('saddress');
                $student->class = $request->input('sclass');
                $student->teacher = $request->input('steacher');
                $selectedCasts = $request->input('scast',[]);
                $cast = implode(', ', $selectedCasts);
                $student->cast = $cast;
                $student->save();
                $student->load('class_relation', 'teacher_relation');
                $data = [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'address' => $student->address,
                    'class_name' => $student->class_relation ? $student->class_relation->class_name : 'Relationship Not Loaded',
                    'teacher_name' => $student->teacher_relation ? $student->teacher_relation->name : 'Relationship Not Loaded',
                    'cast' => $student->cast,
                ];
                break;

            case 'class': // Class tab
                $this->validate($request, [
                    'cclass' => 'required|string|max:255',
                ]);

                $class = new Classe;
                $class->class_name = $request->input('cclass');
                $class->save();
                $data=$class;
                break;

            case 'teacher': // Teacher tab
                $this->validate($request, [
                    'tname' => 'required|string|max:255',
                    'gender' => 'required|string',
                ]);

                $teacher = new Teacher;
                $teacher->name = $request->input('tname');
                $teacher->gender = $request->input('gender');
                $teacher->save();
                $data=$teacher;
                break;

            default:
                return response()->json(['error' => 'Invalid form data'], 400);
        }

        return response()->json(['message' => 'Data successfully stored','active_tab'=>$active_tab,'data'=>$data], 200);
    }

    public function getRecord($type, $id)
    {
        switch ($type) {
            case 'student':
                $record = Student::find($id);
                break;
            case 'class':
                $record = Classe::find($id);
                break;
            case 'teacher':
                $record = Teacher::find($id);
                break;
            default:
                return response()->json(['success' => false]);
        }

        if ($record) {
            return response()->json(['success' => true, 'data' => $record]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function delete_record(Request $request,$id)
    {
        $formType = $request->input('form_type');
        switch ($formType) {
        case 'student':
            $data = Student::find($id);
            $data->delete();
            break;

        case 'class':
            $data = Classe::find($id);
            $data->delete();
            break;

        case 'teacher':
            $data = Teacher::find($id);
            $data->delete();
            break;

        default:
            return response()->json(['success' => false, 'message' => 'Invalid form type'], 400);
        }

         return response()->json(['success' => true, 'message' => 'Record(s) deleted successfully'], 200);
    }

}

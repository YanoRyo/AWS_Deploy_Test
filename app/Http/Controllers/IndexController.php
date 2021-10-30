<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Name;
use App\Questionnaire;
use App\Teacher;
use Illuminate\Support\Facades\Mail; //追記
use App\Mail\SendMail; //追記
use \InterventionImage;

class IndexController extends Controller
{
    //
    
    public function index(){
        
        
        
        $questionnaire01 = Questionnaire::select('que_1')->get();
        $questionnaire02 = Questionnaire::select('que_2')->get();
        $questionnaire03 = Questionnaire::select('que_3')->get();
        $questionnaire04 = Questionnaire::select('que_4')->get();
        $questionnaire05 = Questionnaire::select('que_5')->get();
        
        $data01 = $questionnaire01->count();
        $data02 = $questionnaire02->count();
        $data03 = $questionnaire03->count();
        $data04 = $questionnaire04->count();
        $data05 = $questionnaire05->count();
        
        
        $questionnaire1 = Questionnaire::sum('que_1');
        $questionnaire2 = Questionnaire::sum('que_2');
        $questionnaire3 = Questionnaire::sum('que_3');
        $questionnaire4 = Questionnaire::sum('que_4');
        $questionnaire5 = Questionnaire::sum('que_5');
        
        $que01_num = $questionnaire1/$data01;
        $que02_num = $questionnaire2/$data02;
        $que03_num = $questionnaire3/$data03;
        $que04_num = $questionnaire4/$data04;
        $que05_num = $questionnaire5/$data05;
        
        // dd($que01_num);
        
    
        
        // foreach($questionnaires as $questionnaire){
            
        //     $array[] = $questionnaire->que_1;
            
        //     $sum_num = $array->sum();
        // }
        // dd($array->sum());
        
        // $count_data = $questionnaires->que_1;
        
        // $count_datas = $count_data->count();
        
        // dd($count_datas);
    	
    	return view('index',compact('que01_num','que02_num','que03_num','que04_num','que05_num'));
    }
    
    public function store(Request $request){
    	
    	$name = new Name;
    	$name->name = $request->name;
    	$name->save();
    	return redirect('index');
    }
    
    public function move(){
        
        // $names = Name::all();
        // // dd($names);
    // 	$list = Name::all();
        
    //     $lists = response()->json(['lists' => $list]);
    // 	return view('index2',compact('lists'));
        
        $names = Name::all();
        
        $name = response()->json($names);
        
        dd($name);
    
    }
    
    public function show(){
        
        return view('questionnaire');
    }
    
    public function store1(Request $request)
    {
       
        $questionnaire = new Questionnaire;
        
        $questionnaire->que_1 = $request->que_1;
        $questionnaire->que_2 = $request->que_2;
        $questionnaire->que_3 = $request->que_3;
        $questionnaire->que_4 = $request->que_4;
        $questionnaire->que_5 = $request->que_5;
        $questionnaire->comment = $request->comment;
        $questionnaire->save();
        
        return redirect('index');
    }
    
    public function teachers(){
        
        
        $teachers = Name::all();
        
        
        
        return view('teachers',compact('teachers'));
        
    }
    
    public function store2(Request $request){
        
        $teacher = new Teacher;
        
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->save();
        
        return redirect('teachers');
    }
    
    // public function send(Request $request){
        
        
    //     $name = $request->name;
    //     $mail = $request->email;
        
    //     Mail::send(new SendMail($name,$mail));
    //     return view('teachers');
    // }
    
    public function send(Request $request){
        
        //formからの画像リクエストはimagefileで受け付けしたのでimagefileを設定しています。formに合わせて変更してください。
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        //アスペクト比を維持、画像サイズを横幅1080pxにして保存する。
        // InterventionImage::make($file)->resize(1080, 700)->save(public_path('/images/' . $name ) );;   
        $upload_image = InterventionImage::make($file)->fit(640, 360)->encode('jpg');
        
        $teacher = new Name();
        // $upload_image = $request->file('image');
        
        // $slug = Str::slug($request->title);
        // $request->file('image')->storeAs('images/achievements/', $slug . '.' . $request->image->extension());
    
        // $thumbnail = InterventionImage::make($request->image)->fit(273, 270);
        // $thumbnail->save('images/achievements/'. $slug . '-thumbnail.' . $request->image->extension());
    
    
    
        // if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('public');
			//画像の保存に成功したらDBに記録する
			if($path){
				$teacher->image = $upload_image->storeAs('/storage/teacher_images', $name . '.jpg');
				$request->image->storeAs('public/teacher_images', $name . '.jpg');
			}
		}
		$teacher->save();
    }
}

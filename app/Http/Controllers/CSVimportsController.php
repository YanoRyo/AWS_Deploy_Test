<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// use App\Csv;
use App\Lesson;
use App\Teacher;
//useしないと 自動的にnamespaceのパスが付与されるのでuse
use SplFileObject;

class CSVimportsController extends Controller
{
    //
    protected $csv = null;
    
    // public function __construct(Lesson $csv){
    // 	$this->csv_import = $csv;
    // }
    
    public function index(){
    	
    // 	$csvs = Lesson::all();
    // 	$arrays_class = array();
    //     foreach($csvs as $csv){
    //         array_push($arrays_class,$csv->class_name);
    //     }
        // 桁数を揃えるコード
        // $arrays_num = array();
        // foreach($arrays_class as $array_class){
        //     $array_num = preg_replace('/[^0-9]/', '', $array_class);
        //     array_push($arrays_num,$array_num);
            
        // }
       
        // $corect_nums = array();
        // foreach($arrays_num as $array_num){
        //     $cut = (strlen($array_num) - 8);
        //     // dd($cut);
        //     if(strlen($array_num) > 8){
        //         $replace = mb_substr( $array_num , 0 , mb_strlen($array_num)-$cut );
        //         array_push($corect_nums,$replace);
        //     }else{
        //         array_push($corect_nums,$array_num);
        //     }
        // }
        // dd($corect_nums);
        
       
    	$csvs = Teacher::all();
        $lessons = Lesson::all();
        $arrays_teacher = array();
        foreach($lessons as $lesson){
            array_push($arrays_teacher,$lesson->teacher_name);
        }
        $arrays_id = array();
        $arrays_name = array();
        foreach($arrays_teacher as $array_teacher){
            foreach($csvs as $csv){
                $teacher_name = $csv->name;
                $teacher_id = $csv->id;
                if(preg_match("/$array_teacher/",$teacher_name)){
                    // $teachers_id = $teacher_id;
                    // echo($teacher_name."\n");
                    array_push($arrays_name,$teacher_name);
                    array_push($arrays_id,$teacher_id);
                // echo($teacher_id."\n");
                }
               
            }
            
        }
        // dd($arrays_id);
        
        return view('csvimport_index',compact('csvs','lessons','arrays_id'));
        // return view('csvimport_index',compact('arrays_id'));

    }
    
    public function import(Request $request){
    	// dd($request);
    	//全件削除
    	Teacher::truncate();
    	// ロケールを設定(日本語に設定)
    	setlocale(LC_ALL, 'ja_JP.UTF-8');
    	// アップロードしたファイルを取得
    	// 'csv_file' はビューの inputタグのname属性
    	$uploaded_file = $request->file('csv_file');
    	// アップロードしたファイルの絶対パスを取得
    	$file_path = $request->file('csv_file')->path($uploaded_file);
    	//SplFileObjectを生成
    	$file = new SplFileObject($file_path);
    	//SplFileObject::READ_CSV が最速らしい
    	$file->setFlags(SplFileObject::READ_CSV);
    	//配列の箱を用意
    	$array = [];
    	
    	$row_count = 1;
    	
    	//取得したオブジェクトを読み込み
    	foreach($file as $row){
    		// 最終行の処理(最終行が空っぽの場合の対策
    		if($row === [null]) continue;
    		
    		// 1行目のヘッダーは取り込まない
    		if($row_count > 1){
    			// CSVの文字コードがSJISなのでUTF-8に変更
    			$id = mb_convert_encoding($row[0],'UTF-8','SJIS');
    			$name = mb_convert_encoding($row[1],'UTF-8','SJIS');
    // 			$checkin_date = mb_convert_encoding($row[2],'UTF-8','SJIS');
    // 			$total_price = mb_convert_encoding($row[3],'UTF-8','SJIS');
    			
    			$csvimport_array = [
                'id' => $id, 
                'name' => $name 
                // 'checkin_date' => $checkin_date, 
                // 'total_price' => $total_price
                ];
 
                // つくった配列の箱($array)に追加
                array_push($array, $csvimport_array);
     
                    // 数が多いと処理重すぎなのでバルクインサートに切り替える
                    // CSVimport::insert(array(
                    //     'name' => $name, 
                    //     'reserved_date' => $reserved_date, 
                    //     'checkin_date' => $checkin_date, 
                    //     'total_price' => $total_price
                    // ));
    		}
    		$row_count++;
    	}
    	
    	//追加した配列の数を数える
        $array_count = count($array);
    	//追加した配列の数を数える
        $array_count = count($array);
     
        //もし配列の数が500未満なら
        if ($array_count < 500){
     
            //配列をまるっとインポート(バルクインサート)
            Teacher::insert($array);
     
     
        } else {
            
            //追加した配列が500以上なら、array_chunkで500ずつ分割する
            $array_partial = array_chunk($array, 500); //配列分割
       
            //分割した数を数えて
            $array_partial_count = count($array_partial); //配列の数
     
            //分割した数の分だけインポートを繰り替えす
            for ($i = 0; $i <= $array_partial_count - 1; $i++){
            
                Teacher::insert($array_partial[$i]);
            
            }
        
     
        }
        
        $csvs = Teacher::all();
        $lessons = Lesson::all();
    	return view('csvimport_index',compact('csvs','lessons'));

    }
    
}
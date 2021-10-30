<!DOCTYPE html>
<html>
    <head>
        <title>BookingcurveTest</title>
 
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
 
        <style>
 
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
    
                <div class="title">Bookingcurve</div>
 
                <h4>CSVファイルを選択してください</h4>
                <div class="row">
                    <div class="col-md-6">
                    ■手順
 
                    1. CSVで保存します。
 
                    2. ファイルを選択し読み込んでください。
 
                    </div>
                </div>
                
                <form role="form" method="post" action="import" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="csv_file" id="csv_file">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-success">保存</button>
                    </div>
                </form>
 
            </div>
        </div>
        @foreach($arrays_id as $array_id)
        <p style=line-height:0px;>{{$array_id}}</p>
        @endforeach
    </body>
</html>
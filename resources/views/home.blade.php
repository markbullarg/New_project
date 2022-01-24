@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ultimas Noticias') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--{{ __('You are logged in!') }}-->
    

                    <?php

                    $api_url = 'https://hacker--news-firebaseio-com.translate.goog/v0/newstories.json';
                    $json_data = file_get_contents($api_url);
                    $new_stories = json_decode($json_data);
                    $top_10_stories = array_slice($new_stories, 0, 100);
                    
                    $a=0;
                    
                    foreach ($top_10_stories as $val) {
                        #print "$val <br>";
                        try {
                            //code...
                            $api_url = 'https://hacker-news.firebaseio.com/v0/item/'.$val.'.json';
                            #echo $api_url.'<br>';
                            $json_data = file_get_contents($api_url);
                            $story_detail_obj = json_decode($json_data);
                            $story_detail = get_object_vars($story_detail_obj);
                            #print_r($response_data);
                            $title = $story_detail['title'];
                            $link = $story_detail['url'];
                            

                            $checkbox = '<form method="POST" action="fav">
                                        <input type="hidden" name="_token" id="token" value=".{{ csrf_field() }}.">

                                            <label for="'.$story_detail['url'].'">
                                                <input type="checkbox" id="'.$story_detail['url'].'"/>
                                            </label>
                                            
                                            <input type="submit" name="submit1" value="Agregar a favoritos" />
                                        </form>';
                            
                            echo '<a href="'.$link.'">'.$title.'</a>'.$checkbox.'<br>';
                        } catch (\Throwable $th) {
                            //throw $th;
                            //print_r('ERROR');
                        }

                        if ($a == 10) {
                            # code...                          
                            break;
                        }
                        $a= $a + 1;
                        
                    }
                        
                        
                        #if(isset($_POST['submit1'])){ //check if form was submitted
                        #$input = $_POST['inputText']; //get input text
                        #$message = "Success! You entered: ".$input;

                        #id_noticia = Agarro id de noticia 
                        #id_usuario = 
                        #isChecked = 1/0

                        #ejecutar proceso en la base
                        #EXEC SP_actualiza_favoritos

                        #MERGE 
                        #echo 'hola';
                        #} 
                        

                        #echo $response_data['title'];
                        /*$checkbox = '<button type="button">'.'Agregar a favoritos'.'</button>';
                        
                        echo '<a href="'.$link.'">'.$title.'</a>'.$checkbox.'<br>';
                        #echo $response_data['title'];}*/
                        
                    //}
                    

                    

                    

                    // Print data if need to debug
                    #print_r($user_data);
                    ?>  
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

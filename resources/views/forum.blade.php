 @extends('layouts.app')
 @section('style')
     <style>
         .actions a,
     .actions form{
     display: inline-block;

     }
     .actions {
     margin-left:80%;
     }
     .c_info{
     background-color:rgba(128,189,255,0.2)  ;

     }
     .c_user{
     font-size: 150%;
     }
     .c_time{
     margin-left: 2%;
     }
     .c_text{
     height :100%;
     padding: 10px;
     }
     .table{
     margin-top:5%;
     }
     .comment_btn{
     margin:0 0 0 90% ;
     }
     .comments{
     background-color: #eee;
     margin-top:0;
     width: 100%;
     padding: 5%;
     }
         .table,.fform{
             background-color: #fff;
             border: 3px solid #fff;
         }

     </style>
     @endsection
 @section('content')

<div class="container">
 <div class="comments">
     <h3>Questions</h3>
     @auth

         <form class="fform"  @if(isset($question_e)) action="{{route('question.update',["id"=>$question_e->id])}}" @else action="{{route('question.store')}}"@endif  method="post">
            {{csrf_field()}}
             @if(isset($question_e))  <input type="hidden" name="_method" value="put"> @endif

             <div class="form-group ">
                 <div class="input-group ">
                     <input   name="subject"   placeholder="Write your Question"  class="form-control my-2   " @if(isset($question_e)) value="{{$question_e->subject}}" @endif required>

                 </div>
             </div>
             <button class="btn btn-success comment_btn my-2  my-sm-0 " type="submit">Save</button>

         </form>
         @endauth
     @if($questions->count()===0)
         No questions found
     @else

     <table class="table table-sm table-responsive-md table-responsive-sm table-striped table-bordered">

         @foreach($questions as $question)
             <tr><td>
                     <div><div class="c_info">
                             <div class="c_user"><b><i class="fa fa-user"></i> {{$question->user->name}}</b></div>
                             <div class="c_time">time:{{$question->updated_at}}</div></div>
                         <div class="c_text"> <a href="{{route('question.show',['id'=>$question->id])}}"><b><h4>{{$question->subject}}</h4></b></a></div></div>
                    @auth
                     @if(Auth::user()->id===$question->user_id)
                         <div class="actions">   <a class="btn btn-outline-primary  my-2  my-sm-0 " href="{{route('question.edit',['id'=>$question->id])}}" role="button"> Edit</a>

                             <form action="{{route('question.destroy',['id'=>$question->id])}}" method="post" >
                                 {{ csrf_field() }}
                                 <input type="hidden" name="_method" value="delete">
                                 <input class="btn btn-outline-danger  my-2  my-sm-0 " type="submit" value="Delete">
                             </form></div>
                     @endif
                        @endauth

                 </td>
             </tr>




             @endforeach
             </tbody>
     </table>
     @endif
 </div>
</div>
 @endsection
 @section('script')
 @endsection

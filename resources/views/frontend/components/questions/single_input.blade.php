<div class="single-input">
    <div class="mb-2">
        <input type="text" class="form-control {{isset($question->answer_aligment)?($question->answer_aligment == 'offset-md-0')?'col-12':'col-6  '.$question->answer_aligment:''}}" id="{{$question->id}}" name="single_input[]" placeholder="Write your answer" @if($question->required) required @endif>
        <span class="message mt-2"></span>
    </div>
    <div class="more_answers">
    </div>
    <!-- @if($question->more_than_one_answer==1)
        <div class="genius-btn mt60 gradient-bg ml-auto custom-btn">
            <a href="javascript:void(0);" class="btn-add-answer">Add another answer</a>
        </div>
    @endif -->
</div>
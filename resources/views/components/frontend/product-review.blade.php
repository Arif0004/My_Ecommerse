@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endpush
<div class="col-md-6">
    <form method="post" action="{{ route('review') }}" id="reviewStorForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
    <h4 class="mb-4">Leave a review</h4>
    <small>Your email address will not be published. Required fields are marked *</small>
    <div class="d-flex">
        <p class="mb-0 mr-2">Your Rating * : <input id="ratting" type="hidden" name="rating"/></p>
        <div class="text-primary">
            <div class="rateyo"
            data-rateyo-rating="0"
            data-rateyo-num-stars="5"
            data-rateyo-score="5">
        </div>
         <div>
            <span class='score' style="color: teal"></span>
            <br>
            <span class='result' style="color: teal"></span>
         </div>
        </div>
        </div>
            <div class="form-group">
                <label for="message">Your Review *</label>
                <textarea id="message" cols="30" rows="5" class="form-control" name="review"></textarea>
            </div>

            <div class="form-group mb-0">
                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
            </div>
        </form>
    </div>



@push('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

 <script>
const $$ = (el) => document.querySelector(el);
let ratingInput = $$('#ratting');

$(function () {
  $(".rateyo").rateYo({ fullStar: true, rating: 0}).on("rateyo.change", function (e, data) {
    var rating = data.rating;
    // $(this).parent().find('.score').text('Total Rating :'+ $(this).attr('data-rateyo-score'));
    // $(this).parent().find('.result').text('You have given :'+ rating);
    ratingInput.value = rating
   });
});

$('#reviewStorForm').validate({
        rules: {

            review :{
                required: true
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });

 </script>

@endpush

<div class="certificates">
      <div class="container">
       <div class="row">
         <div class="col-12 text-center text-md-left justify-content-sm-center  col-md-6 opcol1">
      <h1>@if(isset($files['iso-certificate-logo']))    @if($files['iso-certificate-logo']['status']==1)  <img src="{{asset('/uploads/'.$files['iso-certificate-logo']['image'])}}" height="40px" width="auto"> @else
           @endif @endif</h1>

             <!--This html is for simple underline and its code start from here -->
             <div class="rline">
                 <div class="line">
               </div>
           </div>
          <!--This html is for simple underline and its code ends here -->
           </div>
       </div> 
         <div class="row">
          @if(isset($files['iso-certificate-1']))
        @if($files['iso-certificate-1']['status']==1)
         <div class="col-12 d-flex justify-content-center justify-content-md-start col-md-4 iso-certificate">
              <div class="img-holder">
                <img class="img-thumbnail zoom"  src="{{asset('/uploads/'.$files['iso-certificate-1']['image'])}}" style="object-fit: cover;" alt="iso certificate 1">
             </div>
         </div>
         @else
         @endif
         @endif
         @if(isset($files['iso-certificate-2']))
           @if($files['iso-certificate-2']['status']==1)
         <div class="col-12 d-flex justify-content-center justify-content-md-start col-md-4  iso-certificate">
             <div class="img-holder">
         <img class="img-thumbnail zoom" src="{{asset('/uploads/'.$files['iso-certificate-2']['image'])}}" style="object-fit: cover;" alt="iso certificate 2">
             </div>
         </div>
         @else
         @endif
         @endif
         @if(isset($files['iso-certificate-3']))
          @if($files['iso-certificate-3']['status']==1)
         <div class="col-12 d-flex justify-content-center justify-content-md-start  col-md-4  iso-certificate">
            <div class="img-holder">
             <img class="img-thumbnail zoom" src="{{asset('/uploads/'.$files['iso-certificate-3']['image'])}}" style="object-fit: cover;" alt="iso certificate 3">
            </div>
        </div>
        @else
        @endif
        @endif
       </div>

    </div>
</div>

<!-- Slider html starts here  -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">

    @foreach($sliders as $slider)
    @if ($loop->first)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $slider->index }}" class="active"></li>
    @else
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $slider->index }}"></li>
    @endif
    @endforeach   

  </ol>
  <div class="carousel-inner">

    @foreach($sliders as $slider)
    @if ($loop->first)
    <div class="carousel-item active">
    @else
    <div class="carousel-item">
    @endif
      <img class="d-block w-100" src="@isset($slider->image)
      {{asset('/uploads/'.$slider->image)}}
      @endisset" alt="">
        <div class="absolute-div">
        <div class="carousel-caption carouselFont animated pulse" style="animation-delay: 2s">
         <h3>@isset($slider->title_first_line)
          {{$slider->title_first_line}}
         @endisset <br><span class="slidertext">
          @isset($slider->title_second_line)
          {{$slider->title_second_line}}
          @endisset 
         </span></h3>
          </div>
        </div>
    </div>
    @endforeach

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- Slider HTML ends here -->

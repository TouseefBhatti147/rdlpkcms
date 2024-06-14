<{{"?"}}xml version="1.0" encoding="UTF-8"{{"?"}}>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url><loc>{{url('/')}}</loc></url>
<url><loc>{{url('/brochure')}}</loc></url>
<url><loc>{{url('/uploads/1571747915_1423.pdf')}}</loc></url>
<url><loc>{{url('/about-us')}}</loc></url>
@foreach($currentProjects as $cr_project)
<url>
  <loc>{{url('/current-projects/'.$cr_project->alias)}}</loc>
</url>
@endforeach
@foreach($upcomingProjects as $cr_project)
<url>
<loc>{{url('/upcoming-projects/'.$cr_project->alias)}}</loc>
</url>
@endforeach
@foreach($allnews as $news)
<url>
<loc>{{url('/news/'.$news->alias)}}</loc>
</url>
@endforeach
@foreach($allevents as $events)
<url>
<loc>{{url('/events/'.$events->alias)}}</loc>
</url>
@endforeach

@foreach($newsletters as $newsl)
<url>
<loc>{{url('/newsletters/'.$newsl->alias)}}</loc>
</url>
@endforeach

<url>
<loc>{{url('/contact-us')}}</loc>
</url>
<url>
<loc>
  @if($pages['terms-of-service']['status']==1)
    {{url('/pages/'.$pages['terms-of-service']['alias'])}}
    @else
      #
   @endif
</loc>
</url>
<url>
<loc>
  @if($pages['privacy-policy']['status']==1)
    {{url('/pages/'.$pages['privacy-policy']['alias'])}}
    @else
      #
   @endif
</loc>
</url>




</urlset>

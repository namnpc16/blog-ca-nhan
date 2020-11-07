@extends('frontend.layouts')

@section('title')
    Home
@endsection

@section('content')
<section id="bricks">

    <div class="row masonry">

        <!-- brick-wrapper -->
      <div class="bricks-wrapper">

          <div class="grid-sizer"></div>

          <div class="brick entry featured-grid animate-this">
              <div class="entry-content">
                  <div id="featured-post-slider" class="flexslider">
                        <ul class="slides">

                            <li>
                                <div class="featured-post-slide">

                                    <div class="post-background" style="background-image:url('images/thumbs/featured/featured-1.jpg');"></div>

                                    <div class="overlay"></div>			   		

                                    <div class="post-content">
                                        <ul class="entry-meta">
                                             <li>September 06, 2016</li> 
                                             <li><a href="#" >Naruto Uzumaki</a></li>				
                                         </ul>	

                                        <h1 class="slide-title"><a href="single-standard.html" title="">Minimalism Never Goes Out of Style</a></h1> 
                                    </div> 				   					  
                            
                                </div>
                            </li> <!-- /slide -->

                            <li>
                                <div class="featured-post-slide">

                                    <div class="post-background" style="background-image:url('images/thumbs/featured/featured-2.jpg');"></div>

                                    <div class="overlay"></div>			   		

                                    <div class="post-content">
                                        <ul class="entry-meta">
                                             <li>August 29, 2016</li>
                                             <li><a href="#">Sasuke Uchiha</a></li>					
                                         </ul>	

                                        <h1 class="slide-title"><a href="single-standard.html" title="">Enhancing Your Designs with Negative Space</a></h1>
                                    </div>		   				   					  
                            
                                </div>
                            </li> <!-- /slide -->

                            <li>
                                <div class="featured-post-slide">

                                    <div class="post-background" style="background-image:url('images/thumbs/featured/featured-3.jpg');;"></div>

                                    <div class="overlay"></div>			   		

                                    <div class="post-content">
                                        <ul class="entry-meta">
                                             <li>August 27, 2016</li>
                                             <li><a href="#" class="author">Naruto Uzumaki</a></li>					
                                         </ul>	

                                        <h1 class="slide-title"><a href="single-standard.html" title="">Music Album Cover Designs for Inspiration</a></h1>
                                    </div>

                                </div>
                            </li> <!-- end slide -->

                        </ul> <!-- end slides -->
                    </div> <!-- end featured-post-slider -->        			
              </div> <!-- end entry content -->         		
          </div>
{{-- {{ dd($posts->posts) }} --}}
        @foreach ($posts as $post)
            <article class="brick entry format-standard animate-this">

                <div class="entry-thumb">
                <a href="{{ route('post', ['slug' => $post->slug]) }}" class="thumb-link">
                    <img src="{{ asset('') }}storage/photos/image/{{ $post->img }}" alt="building">             
                </a>
                </div>

                <div class="entry-text">
                    <div class="entry-header">

                        <div class="entry-meta">
                            <span class="cat-links">
                                @foreach ($post->categories as $category)
                                    <a href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>     
                                @endforeach
                            </span>			
                        </div>

                        <h1 class="entry-title"><a href="{{ route('post', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h1>
                        
                    </div>
                        <div class="entry-excerpt">
                            {!! Str::limit($post->description, 300, '...') !!}
                        </div>
                </div>

            </article> <!-- end article -->
        @endforeach

         

         <!-- format audio here -->
         {{-- <article class="brick entry format-audio animate-this">

            <div class="entry-thumb">
               <a href="single-audio.html" class="thumb-link">
                   <img src="images/thumbs/concert.jpg" alt="concert">                      
               </a>

               <div class="audio-wrap">
                   <audio id="player" src="media/AirReview-Landmarks-02-ChasingCorporate.mp3" width="100%" height="42" controls="controls"></audio>                  	
               </div>
            </div>

            <div class="entry-text">
                <div class="entry-header">

                    <div class="entry-meta">
                        <span class="cat-links">
                            <a href="#">Design</a> 
                            <a href="#">Music</a>                				
                        </span>			
                    </div>

                    <h1 class="entry-title"><a href="single-audio.html">This Is a Audio Format Post.</a></h1>
                    
                </div>
                     <div class="entry-excerpt">
                         Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.
                     </div>
            </div>
            
             </article> <!-- /article --> --}}


          {{-- <article class="brick entry format-quote animate-this" >

            <div class="entry-thumb">                  
                <blockquote>
                      <p>Good design is making something intelligible and memorable. Great design is making something memorable and meaningful.</p>

                      <cite>Dieter Rams</cite> 
                </blockquote>	          
            </div>   

             </article> <!-- end article --> --}}

          

           	

             

             {{-- < class="brick entry format-link animate-this">

            <div class="entry-thumb">
               <div class="link-wrap">
                      <p>Looking for affordable &amp; reliable web hosting? We recommend Dreamhost.</p>
                      <cite>
                          <a target="_blank" href="http://www.dreamhost.com/r.cgi?287326">http://www.dreamhost.com</a>
                      </cite>
                </div>	
            </div>               
            
             </> <!-- end article --> --}}


         

             

             

             

      </div> <!-- end brick-wrapper --> 

    </div> <!-- end row -->

    <div class="row">
        
        <nav class="pagination">
           {{-- <span class="page-numbers prev inactive">Prev</span> --}}
            {{-- <span class="page-numbers current">1</span>
            <a href="#" class="page-numbers">2</a>
           <a href="#" class="page-numbers">3</a>
           <a href="#" class="page-numbers">4</a>
           <a href="#" class="page-numbers">5</a>
           <a href="#" class="page-numbers">6</a>
           <a href="#" class="page-numbers">7</a>
           <a href="#" class="page-numbers">8</a>
           <a href="#" class="page-numbers">9</a> --}}
           {{ $posts->links() }}    
            {{-- <a href="#" class="page-numbers next">Next</a> --}}
       </nav>
       

    </div>

</section> <!-- end bricks -->
@endsection
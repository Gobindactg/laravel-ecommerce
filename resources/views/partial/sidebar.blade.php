	<div class="col-md-3">
		<div class="list-group w-100">
        @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NUll)->get() as $parent)
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item search_custom">
                    <h2 class="accordion-header search_custom" id="flush-headingOne">
                        <a  href="#main-{{$parent->id}}" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#main-{{$parent->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="text-decoration: none;">
                        <img src="{{ asset('assets/categoryImage/'. $parent->image) }}" alt="$parent->name" style="width:40px; height:30px; padding-right:5px">
                            {{$parent->name}}
                        </a>
                    </h2>
                    <div id="main-{{$parent->id}}" class="collapse 
                    @if (Route::is('category.show'))
                            @if (App\Models\Category::ParentOrNotCategory($parent->id, $category->id))
                            show
                            @endif
                        @endif              
                    
                    " aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                    <div class="accordion-body 
                    @if (Route::is('category.show'))
                            @if ($child->id == $category->id)
                           bg-info
                            @endif
                        @endif
                    ">
                        <a  href="{{route('category.show', $child->slug)}}" style="text-decoration: none;" 
                        class="">
                        ==> <img src="{{ asset('assets/categoryImage/'. $child->image) }}" alt="$child->name" style="width:40px; height:30px; padding-right:5px">
                           {{$child->name}}
                        </a>    
                    </div>
                    
                    @endforeach
                    </div>
                </div>
            </div>
        @endforeach
		</div>
	</div>
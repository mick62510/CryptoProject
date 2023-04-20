@extends('layout')



@section('content')

    <section class="row">
        <div class="col-md-6 col-sm-12">
            <div id="with-header" class="card">
                <div class="card-header">
                    <h4 class="card-title">With Header</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body border-top-blue-grey border-top-lighten-5 ">
                        <h4 class="card-title">Content title</h4>
                        <p class="card-text">Add a heading to card with <code>.card-header </code> class &amp; content
                            title uses <code>.card-title</code> class. For border add <code>.border-top-COLOR</code>
                            class</p>
                        <p class="card-text">You may also include any &lt;h1&gt;-&lt;h6&gt; with a
                            <code>.card-header </code> &amp; <code>.card-title</code> class to add heading.</p>
                        <p class="card-text">Jelly beans sugar plum cheesecake cookie oat cake soufflé. Tart lollipop
                            carrot cake sugar plum. Marshmallow wafer tiramisu jelly beans.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group">
        <h5>Large Modal</h5>
        <p>Add class <code>.modal-lg</code> with <code>.modal-dialog</code> to use large size of modal.</p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success block btn-lg" data-toggle="modal" data-target="#large">
            Launch Modal
        </button>

        <!-- Modal -->
        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Basic Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Check First Paragraph</h5>
                        <p>Oat cake ice cream candy chocolate cake chocolate cake cotton candy dragée apple pie. Brownie
                            carrot
                            cake candy canes bonbon fruitcake topping halvah. Cake sweet roll cake cheesecake cookie
                            chocolate cake
                            liquorice. Apple pie sugar plum powder donut soufflé.</p>
                        <p>Sweet roll biscuit donut cake gingerbread. Chocolate cupcake chocolate bar ice cream. Danish
                            candy
                            cake.</p>
                        <hr>
                        <h5>Some More Text</h5>
                        <p>Cupcake sugar plum dessert tart powder chocolate fruitcake jelly. Tootsie roll bonbon toffee
                            danish.
                            Biscuit sweet cake gummies danish. Tootsie roll cotton candy tiramisu lollipop candy cookie
                            biscuit pie.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

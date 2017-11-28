<?php
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Offer;
    use Redirect;
    use Validator;
    use config;
    use Response;
    use App\Cart;

    class OffersController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function add_offer()
        {

            return view('admin.offers.offer_add');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function add_offer_save(Request $r)
        {
            $foreign_name = mt_rand(111111,999999);
            $title = $r->input('title');
            $content = $r->input('content');
            $category = $r->input('cat_id');
            $price = $r->input('price');


            $photo = $r->file('photo');

            $data = ['title' => $title,'content'=> $content, 'cat_id' => $category,'photo' => $photo,'price' => $price];

            $rules = ['title' => 'required' ,'content' => 'required','cat_id' => 'required','photo'=> 'required','price' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v);
            }else
            {
                $destination = 'uploads/offers';
                $photo_name = str_replace(' ', '_', $foreign_name);
                $photo_name .= '.'.$photo->getClientOriginalExtension();
                $photo->move($destination, $photo_name);

                $offer = new Offer();
                $offer->title = $title;
                $offer->content = $content;
                $offer->cat_id = $category;
                $offer->img_name = $photo_name;

                $offer->image_url_original = config('app.my_url').$photo_name;
                $offer->status = 0;
                $offer->price = $price;

                $offer->save();


                return Redirect::back()->with('success', 'New Offer successfuly created');


            }
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function manage_offer()
        {
            $offers = Offer::orderBy('id','DESC')->get();
            return view('admin.offers.manage_offer_index',compact('offers'));
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function publish_offer($id)
        {
             $offer = Offer::findOrFail($id);
     if($offer->status == '0')
     {
       $offer->status = '1';
       $offer->save();
       return Redirect::Back()->with('success', 'This offer is Published');
     }
     else{
      $offer->status = '0';
      $offer->save();
      return Redirect::Back()->with('success', 'This offer is Unpublished');
    }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function view_offer($id)
        {
             $offers = Offer::findOrFail($id);
    
           return view('admin.offers.view_offer',compact('offers'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function view_offer_update(Request $r, $id)
        {
             $foreign_name = mt_rand(111111,999999);
            $title = $r->input('title');
            $content = $r->input('content');
            $price = $r->input('price');


            $photo = $r->file('photo');

            $data = ['title' => $title,'content'=> $content,'price' => $price];

            $rules = ['title' => 'required' ,'content' => 'required','price' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v);
            }else
            {
                  if($r->hasFile('photo')){
                $destination = 'uploads/offers';
                $photo_name = str_replace(' ', '_', $foreign_name);
                $photo_name .= '.'.$photo->getClientOriginalExtension();
                $photo->move($destination, $photo_name);
}
                $offer = Offer::findOrFail($id);
                $offer->title = $title;
                $offer->content = $content;
                if($r->hasFile('photo')){
                    unlink('uploads/offers/'.$offer->img_name);
                $offer->img_name = $photo_name;

                $offer->image_url_original = config('app.my_url').$photo_name;
               }
                $offer->price = $price;

                $offer->save();


                return Redirect::back()->with('success', 'New Offer successfuly created');


            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function delete_offer(Request $r)
        {
            $id = $r->input('id_offer');
            //return $id;
             $check = Offer::where('id', $id)->count();
        if($check == 1){
            $offer = Offer::findOrFail($id);
            unlink('uploads/offers/'.$offer->img_name);
            $offer->delete();
            $status = 1;
            $message = 'Offer successfuly removed';

        }else{
            $status = -1;
            $message = 'Offer doesn\'t exist anymore';
        }
        return Response::json(['status' => $status, 'message' => $message]);

    
        }
        public function view_cart_offer()
        {

       $carts = Cart::select('invnum')->groupBy('invnum')->get();
       return view('admin.offers.cart_offer_buy',compact('carts'));

        }
    }

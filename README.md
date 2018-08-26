
Бд:

Назва таблиці від назви моделі. Або self::table('name table'') або model::NameTable()

self::select()->get(); //SELECT * FROM ..
self::select(string or array)

self::where(column,key,sign(=/>/<))->get()

self::select('id')->where('id',2)->get()   or     self::select(['id','kek'])->where(['id' => 2])->get() 

self::delete()->where(['id'=>3])->get()

self::update([column=>key])->where(...)->orWhere(...)->save()

self::find(id)->get();

self::select()->first()

self::get()

self::sql("SELECT * FROM `kek` WHERE `lol` = ?")->param([3]);

self::select()->join(name table)->on(parent table column, join column )->moreOn(parent table column, join column )->where(...)->order()->limit(10)->get();

self::select()->group('kek')->get();


ROUTE

Route::get
Route::post()->name()
Route::group(['middleware' => '','as' => ,'path' => 'url'])



session

self::session()->all()  //return $_SESSION;

self::session('lol','kek','io')  // return $_SESSION['lol']['kek']['io'];

self::session()->add(key,value) 




other function

dump()

dd()

en(array)   // last index array

self::twig() 

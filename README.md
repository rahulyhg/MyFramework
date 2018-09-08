
Location:
    
    location()->back()  - href to last page


Graphics

    graphics::img()->uploads('/images')->maxSizeImg(400, 300)->save() 
    
    img($path = img) -- записує в статичну перемінну $_FILES[$name] за умовчуванням img
    
    maxSizeImg($width,$height)  -- перевіряє розмір картинки, якшо більше зменшує до допустимої межі 
    
    save()  - зберігає картинку, (копіює з temp і переносить в соновну папку, видаляє з тепмп)
    
    getPath() - вернути шлях до картинки включаючи її назву
    
    getName()  -- вернути назву картинки
    
    uploads($path = 'public/images/') -- шлях загрузки картинки
    
    
    riseSizeImg($width,$height)  -- змінити картинкку до зазначених велечин
    
    createImg()  - створити ресурс jpg|jpeg|png|gif|bmp
    
    saveImg()  - зберігає картинку методами imagepng


Бд:

    Назва таблиці від назви моделі. Або self::table('name table'') або model::NameTable()**

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

    Route::get('/href','CONTROLLER@ACTION')
    
    Route::post('/href','CONTROLLER@ACTION')
    
    Route::post()->name('lol')
    
    Route::group(['middleware' => '','as' => '' ,'path' => 'url'])



super_arr

    self::session()->all()  //return $_SESSION;
    
    self::session('lol','kek','io')  // return $_SESSION['lol']['kek']['io'];
    
    self::session()->add(key,value) 




other function

    dump()
    
    dd()
    
    en(array)   // last index array
    
    self::twig() 

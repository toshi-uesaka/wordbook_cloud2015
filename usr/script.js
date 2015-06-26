var Pair = function(word,def){
	word = word || "word";
	def = def || "def";

	this.word = word;
	this.def = def;
}

var WordBook = function(){
	
	this.data = []; //Pairをたくさん入れる配列
	this.index = 0; //今どの単語のペアを表示中かのインデックス
	this.htflag = "word"; //今単語と定義のどちらを定義しているかのフラグ
	
	// Ruby から単語帳のデータを引っ張ってくる処理
	// this.data には単語帳のデータを示すPairが格納される
	this.data.push(new Pair("apple","りんご"));
	this.data.push(new Pair("orange","みかん"));
	this.data.push(new Pair("peach","もも"));
	this.data.push(new Pair("banana","バナナ"));
	this.data.push(new Pair("mango","マンゴー"));
	console.log("Setting");
}

WordBook.prototype.getSentence = function(){
	if(this.htflag === "word")
		return this.data[this.index].word;
	return this.data[this.index].def;
}

WordBook.prototype.flip = function(){
	if(this.htflag === "word")
		this.htflag = "def";
	else
		this.htflag = "word";

console.log(this.htflag);
}

WordBook.prototype.next = function(){
	this.index++;
	if(this.index >= this.data.length)
		this.index = this.data.length-1;
console.log(this.index);
}

WordBook.prototype.prev = function(){
	this.index--;
	if(this.index<0)
		this.index = 0;
console.log(this.index);
}

var MyBook = new WordBook();

//DOM要素へのイベントバインド　（あとで綺麗に書き直したい）

$(function(){
$("div#Paper").click(function () {
	MyBook.flip();
	$(this).html(MyBook.getSentence());
});

$("div#Paper").keydown(function(e){
	switch(e.keyCode){
	case 32: //Space
		MyBook.flip();
		$(this).html(MyBook.getSentence());
	break;
		case 39: //Right Cursor
			MyBook.next();
			$(this).html(MyBook.getSentence());
			break;
		case 37: //Left Cursor
			MyBook.prev();
			$(this).html(MyBook.getSentence());
			break;
	}
});
});



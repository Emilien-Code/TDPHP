const short = true;
const long = false;


function Document(ref, title, desc=null){
    this.ref = ref;
    this.title = title;
    this.desc = desc;
}
const DocumentProto = {
    setTitle(title){
        this.title = title;
    },
    setDescription(desc){
        this.desc = desc;
    }
}
Document.prototype = DocumentProto;

class Book extends Document{
    constructor(ref, title, desc=null,icbn=""){
        super(ref, title, desc)
        this.icbn = icbn
    } 
    setIcbn(icbn){
        this.icbn = icbn
    }  
}


class Audio extends Document{
    constructor(ref, title, desc=null, artiste="", label=""){
        super(ref,title,desc);
        this.artiste = artiste;
        this.label = label;
    }
    setArtiste(artiste){
        this.artiste = artiste;
    }
    setLabel(label){
        this.label = label;
    }
}


class Collection {
    constructor(name){
        this.name = name
        this.collection = []
    }

    addDocument(doc){
        this.collection.push(doc);
    }

    setDocumentList(docs=[]){
        docs.forEach((doc)=>{
            this.collection.push(doc);
        })
    }

    lokup(ref){
        return this.collection.find(el => el.ref===ref);
    }
}

class DocumentView {
    constructor(doc){
        this.doc = doc;
    }

    short(){
        return `<span>${doc.title}</span>`
    }
    
    detail (){
        return `<div><h1>${doc.title}</h1> <p>${doc.desc}</p> <p>${doc.ref}</p></div>`
    }

    render(selector){
        return selector===short ? this.short() : this.detail();
    }
}

class AudioView extends DocumentView{
    constructor(doc){
        super(doc);
    }
    short(){
        return `<span> Audio: ${this.doc.title} par ${this.doc.label}</span>`
    }
    detail(){
        return `<div><h1>${this.doc.title}</h1> <p>${this.doc.desc}</p> <p>${this.doc.ref}</p> <p>${this.doc.artiste}</p><p>${this.doc.label}</p></div>`
    }
}

class BookView extends DocumentView{
    constructor(doc){
        super(doc);
    }
    short(){
        console.log("ici", super.short())
        return `<span>Livre: ${this.doc.title}</span>`
    }
    detail(){
        return `<div><h1>${this.doc.title}</h1> <p>${this.doc.desc}</p> <p>${this.doc.ref}</p> <p>${this.doc.icbn}</p></div>`
    }
}


class CollectionView{
    constructor(collec){
        this.collec = collec;
    }

    render(){
        let html = '<ol>';
        this.collec.map((doc) => {
            html += '<li>'
            if(doc instanceof Audio){
                html+=`${new AudioView(doc).render(short)}`
            }else if (doc instanceof Book){
                html+= `${new BookView(doc).render(short)}`
            }else{
                html+= `${new DocumentView(doc).render(short)}`
            }
            html+=`</li>`

        })
        html+=`</ol>`
        return html
    }
}   




//EXEC
const doc = new Document("a", "erklfherifhezkjfh");
const docView = new DocumentView(doc);
const collec = new Collection("nom de la collec") 
const audio = new Audio("#RRFSF","Titre","description","un auteur celebre","Universal");
const audioView = new AudioView(audio)
const book = new Book("#RRFSF","Titre","description","ICBN");
const bookView = new BookView(book)
collec.addDocument(doc)
collec.setDocumentList([audio,book])
const collecView = new CollectionView(collec.collection);

console.log(collecView.render())
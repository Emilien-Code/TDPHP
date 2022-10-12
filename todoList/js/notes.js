// import showdown from "./showdown"

const addButton = document.querySelector("#add");
const createEditNote = document.querySelector(".create_edit_note");
const validateButton = document.querySelector("#form_add_note_valid");
const editButton = document.querySelector("#edit");
const deleteButton = document.querySelector("#del");

class Note{
    constructor(title, content){

    this.title = title;
    this.content = content;
    
    }

    toMarkDown = () => {
        const conv = new showdown.Converter();
        return conv.makeHtml(this.content);
    }

    toHTML = () => {
        const view = document.querySelector("#currentNoteView");
        const md = document.querySelector(".md");
        if(md) md.remove()



        const container = view.appendChild(document.createElement("div"))
        container.className = "md"
        console.log(this.toMarkDown());
        container.innerHTML =`<h1>${this.title}</h1><p>date</p>${this.toMarkDown()}`;
    }
    
    setTitle = (title) => {
        this.title = title;
    }
    
    setContent = (content) => {
        this.content = content;
    }
}
const mainMenuView = {
        addHandler(){
            noteList.selectedNote=null;
            noteFormView.display();
        },

        init(){
            noteList.getList();
            addButton.addEventListener("click", () => {
                this.addHandler();
            })
            editButton.addEventListener("click", ()=>{
                noteList.change()
            })
            deleteButton.addEventListener("click", ()=>{
                noteList.remove()
            })

        }
}
const noteFormView = {
    display(){
        createEditNote.classList.remove("create_edit_note-hidden");
        document.querySelector("#form_add_note_title").value = ""
        document.querySelector("#form_add_note_text").value = "";  
    },

    hide(){
        createEditNote.classList.add("create_edit_note-hidden");
    },

    edit(defaultTitle, defaultContent){
        document.querySelector("#form_add_note_title").value = defaultTitle; 
        document.querySelector("#form_add_note_text").value = defaultContent;
    },

    validate(){
        const titleValue = document.querySelector("#form_add_note_title").value;
        const contentValue = document.querySelector("#form_add_note_text").value;
        noteList.addNote(new Note(titleValue, contentValue));
        
        this.hide();
    }

}
const noteList = {
    liste : [],
    selectedNote : null,

    addNote(note){
        if(this.selectedNote!==null){
            this.liste[this.selectedNote].title = note.title;
            this.liste[this.selectedNote].content = note.content;
            note.toHTML()
        }else{
            this.liste.push(note);
        }
        this.selectedNote = null
        noteListView.displayItem(this.liste);
        this.save();
    },

    getNote(index){
        return this.liste[index];
    },

    save(){
        localStorage.setItem("list", JSON.stringify( this.liste ));
    },

    selectNote(id){
        this.selectedNote = id;
        console.log(this.liste)
        this.liste[id].toHTML()
    },
    change(){
        noteFormView.display()
        noteFormView.edit(this.liste[this.selectedNote].title, this.liste[this.selectedNote].content)
    },
    remove(){
        this.liste.splice(this.selectedNote, 1);
        noteListView.displayItem(this.liste);
        this.save()
    },

    getList(){
        let list = localStorage.getItem("list");
        if(!list){
            this.liste = [];
        }else{
            try{
                const newList = []
                list = JSON.parse(list);
                list.forEach((el)=>{
                    newList.push(new Note(el.title, el.content));
                })
                this.liste = newList;
            }catch{
                this.liste = [];
              }
        }
        noteListView.displayItem(this.liste);
    }
}
const noteListView = {
    displayItem(noteList){
        const list = document.querySelector("#noteListView");
        
        const listItems = document.querySelectorAll(".note_list_item");
        if(listItems){
            listItems.forEach((item)=>{
                item.remove()
            })
        }
            
        noteList.forEach((note)=>{
            const temporedDiv = list.appendChild(document.createElement("div"));
            temporedDiv.innerHTML = `<div class="note_list_item">${note.title}</div>`;
        })

        document.querySelectorAll('.note_list_item').forEach((e) => {
            e.removeEventListener("click", appHandler.select)
        })
        document.querySelectorAll('.note_list_item').forEach((e) => {
            e.addEventListener("click", appHandler.select)
        })
    }
}
const appHandler = {
    select(event) {
        let index = 0;
        document.querySelectorAll('.note_list_item').forEach((element) => {
            if(element == event.target){
                noteList.selectNote(index)
            }
            index++
        })
    },
    
    
    init(){

        validateButton.addEventListener("click",() => {
            noteFormView.validate();
        })
    
        mainMenuView.init();
    
    }
}
window.addEventListener("load", ()=>{

    appHandler.init();

})
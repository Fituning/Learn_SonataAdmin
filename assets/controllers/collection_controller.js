import {Controller} from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static values = {
        prototype: String
    }

    static targets = ["list", "deleteBtn", "addBtn", "item"]
    counter = 0;

    connect() {
        this.counter = this.itemTargets.length
        console.log('connect');
        console.log(this.prototypeValue)

        console.log(this.itemTargets.length)
    }

    add(event) {

        console.log(this.counter)
        let proto = "";
        if (this.hasPrototypeValue) {
            proto = this.prototypeValue.replaceAll("__name__", this.counter);
        }
        console.log(proto);
        let elem = document.createElement("elem",);
        elem.innerHTML = proto
        this.listTarget.appendChild(elem.firstElementChild)
        this.counter++;
    }

    delete(event) {
        // console.log(this.itemTarget.closest("div"));
        // this.itemTarget.parentNode
        console.log(event.target.closest("[data-collection-target=\"item\"]"))
        console.log(this.listTarget)

        this.listTarget.removeChild(event.target.closest("[data-collection-target=\"item\"]"))

    }

    up(event) {
        console.log('event')
        console.log(event)
        // console.log(event.target.closest("[data-collection-target=\"item\"]"))
        console.log(event.target.closest("div").vars)
        // console.log(event.params)


    }

    down(event) {

    }
}

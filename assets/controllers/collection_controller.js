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

    static targets = ["list", "deleteBtn", "addBtn", "item", "position"]
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

        // const selectedItem = event.target.closest("[data-collection-target=\"item\"]")
        // const brutData = selectedItem.dataset.entryId
        // const input = selectedItem.querySelector('input')
        //
        // if (input.value > 1) {
        //     input.setAttribute('value', parseInt(input.value, 10) - 1)
        //
        //     const other = this.listTarget.querySelector(" [value=\"" + input.value.toString() + "\"] ")
        //     const selectedOther = other.closest("[data-collection-target=\"item\"]")
        //
        //     other.setAttribute('value', parseInt(other.value, 10) + 1)
        //
        //     this.listTarget.insertBefore(selectedItem,selectedOther)
        //
        // }else{
        //     console.log("ERROR")
        // }

        const selectedItem = event.target.closest("[data-collection-target=\"item\"]")
        // const brutData = selectedItem.dataset.entryId
        const selectedPosition = selectedItem.querySelector('input')

        if (selectedPosition.value > 1) {
            const newPostion = parseInt(selectedPosition.value, 10) - 1

            const otherItem = this.listTarget.querySelector(" [data-collection-target=\"position\"][value=\""+ newPostion.toString()  +"\"] ")
            const otherPosition = otherItem.closest("[data-collection-target=\"item\"]")

            selectedPosition.setAttribute('value', parseInt(selectedPosition.value, 10) - 1)

            otherItem.setAttribute('value', parseInt(otherItem.value, 10) + 1)

            // this.listTarget.removeChild(selectedItem)
            // this.listTarget.insertBefore(selectedItem,otherPosition.nextElementSibling)
            this.listTarget.insertBefore(selectedItem,otherPosition)

        }else{
            console.log("ALREADY FIRST")
        }

    }


    down(event) {
        const selectedItem = event.target.closest("[data-collection-target=\"item\"]")
        // const brutData = selectedItem.dataset.entryId
        const selectedPosition = selectedItem.querySelector('input')

        if (selectedPosition.value < this.itemTargets.length) {
            const newPostion = parseInt(selectedPosition.value, 10) +1

            const otherItem = this.listTarget.querySelector(" [data-collection-target=\"position\"][value=\""+ newPostion.toString()  +"\"] ")
            const otherPosition = otherItem.closest("[data-collection-target=\"item\"]")

            selectedPosition.setAttribute('value', parseInt(selectedPosition.value, 10) + 1)

            otherItem.setAttribute('value', parseInt(otherItem.value, 10) - 1)

            // this.listTarget.insertBefore(other.closest("[data-collection-target=\"item\"]"),selectedItem)
            // this.listTarget.removeChild(selectedItem)
            // this.listTarget.insertBefore(selectedItem,otherPosition.nextElementSibling)
            this.listTarget.insertBefore(otherPosition,selectedItem)

        }else{
            console.log("ALREADY LAST")
        }
    }
}

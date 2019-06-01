class Error {
    constructor(){
        this.errors = {}
    }

    get(field) {
        if(this.errors[field]) { 
            return this.errors[field][0] 
        } 
    }

    record(errors) {
        this.errors = errors.errors
    }

    warning(title, message) {
        swal(title, message, 'warning')
    }

    clear() {
        this.errors = {}
    }
}

export default {
    data() {
        return {
            errors: new Error
        }
    }
}
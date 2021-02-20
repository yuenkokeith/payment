

var app = new Vue({
    el: '#app',
    data() {
        return {
            form: {
                keyword: ''
            },
            show: false,
            message: "",
            fields: [
                {
                    key: 'index',
                    label: ''
                },
                {
                    key: 'name',
                    label: 'Customer Name',
                    sortable: true,
                },
                {
                    key: 'phone',
                    label: 'Customer Phone',
                    sortable: true,
                },
                {
                    key: 'currency',
                    label: 'Currency',
                    sortable: true,
                },
                {
                    key: 'price',
                    label: 'Price',
                    sortable: true,
                },
            ],
            dataItems: []
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()

            var data = { form: this.form }

            console.log(JSON.stringify(data))
            this.show = true;

            this.$http.post('http://localhost/payment/check-payment/submit', data, { emulateJSON: true })
                .then(response => {

                    var message = response.body;
                    console.log(JSON.stringify(message));
                    console.log(message['msg']);
                    this.show = false;

                    if (message[0]['status'] == 1) {
                        this.dataItems = message[0]['data'];
                    } else {
                        this.message = message[0]['msg'];
                        this.$root.$emit('bv::show::modal', 'check-payment');
                    }

                }, response => {
                    console.error(response.body);
                    this.show = false;
                });


        }

    }

})

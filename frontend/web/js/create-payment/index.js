

var app = new Vue({
    el: '#app',
    data() {
        return {
            form: {
                name: '',
                phone: '',
                currency: null,
                price: '',
            },
            paymentdetail: {
                cardtype: 'VISA',
                cardholdername: '',
                cardnumber: '',
                cardexpirydate: '',
                cardcvv: '',

            },
            currencyOptions: [{ text: 'Select One', value: null }, 'HKD', 'EUR', 'USD', 'JPY', 'SGD'],
            show: false,
            message: "",
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            
            var data = { form: this.form, paymentdetail: this.paymentdetail }

            console.log(JSON.stringify(data))
            this.show = true;

            this.$http.post('http://localhost/payment/create-payment/submit', data, { emulateJSON: true })
                .then(response => {

                    var message = response.body;
                    console.log(JSON.stringify(message));
                    console.log(message['msg']);
                    this.show = false;
                    this.message = message[0]['msg'];
                    this.$root.$emit('bv::show::modal', 'create-payment');

                }, response => {
                    console.error(response.body);
                    this.show = false;
                });


        },
        onReset(event) {
            event.preventDefault()
            // Reset our form values
            this.form.name = ''
            this.form.phone = ''
            this.form.currency = null
            this.form.price = ''
         
        }
    }

})

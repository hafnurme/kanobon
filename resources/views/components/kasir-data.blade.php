<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('podukCart', () => ({
            cart: [],
            before: [],
            add(item) {
                if(this.before) {
                    if(this.before.includes(item.id)) {

                        const cartTemp = this.cart.map((element, index) => {
                            if(element.id == item.id) {
                                element['count'] = parseInt(element['count']) + 1
                                console.log(element['count'],item['stok'])
                                return element
                            }
                            return element
                        })
                        return this.cart = cartTemp
                    }
               
                }

                item['count'] = 1;
                this.before.push(item.id)
                this.cart.push(item);
            },
            addByIndex(index) {
                if(this.cart[index]['count'] == '') {
                   this.cart[index]['count'] = 0
                }
                this.cart[index]['count'] = parseInt(this.cart[index]['count']) + 1
            },
            minByIndex(index) {
                const cartTemp = this.cart.slice(index)

                if(this.cart[index]['count'] === 1 || this.cart[index]['count'] == '') {
                    return
                }

                this.cart[index]['count'] -= 1
            },
            price(index) {
                const harga = this.cart[index]['count']
                const jumlah = this.cart[index]['harga_satuan']
                return `${harga} x ${jumlah} =  ${harga * jumlah}`
            },
            removeFromCart(index) {
                const cartTemp = this.cart.splice(index,1)
                this.before = []
            },
            total(formatted) {
                let total = 0
                this.cart.map((element,index) => {
                    total += element.count * element.harga_satuan
                })

                if(formatted == true) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total)
                }

                return total
            },
            uangDibayar: '',
            kembalian(formatted) {
              let kembalian = this.uangDibayar - this.total()

              if(kembalian <= 0) {
                return 0
              }

              if(formatted) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)
              }

              return kembalian  
            },
            alertMessage : 'error',
            alertVisible : false,
            async bayar() {
                let data = {
                    cart: this.cart,
                    harus_dibayar: this.total(),
                    uang_dibayar: parseInt(this.uangDibayar),
                    kembalian: this.kembalian()
                }
        

                await axios.post('riwayat-transaksi/add',data).then((res) => {
                    setTimeout(() => {
                        document.location.reload()
                    }, 1000);
                }).catch((e) => {
                    console.log(e.response.data.message)
                    this.alertMessage = e.response.data.message
                    this.alertVisible = true
                    this.handleAlert()
                });
            },
            maxInput(e,item,produkIndexInCart) {
                if(e.target.value >= item['stok']) {
                    this.cart[produkIndexInCart]['count'] = item['stok']
                }
            },
          
            handleAlert(message) {
               setTimeout(() => {
                    this.alertVisible = false
               }, 3000);
            }
        }))
    })
</script>
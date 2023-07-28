import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  
  state: () => ({ cart: [] }),
  actions: {
    removeMenuFromCart(MenuId) {
        this.cart.indexOf.forEach((menu, index) => {
            if (menu.id === MenuId) this.cart.splice(index, 1)
        })
    }
  },
  persist: true
})
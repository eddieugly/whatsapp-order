import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  
  state: () => ({ cart: [] }),
  actions: {
    removeMenuFromCart(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId)
      this.cart.splice(menuIndex[menuIndex], 1)
    },
    incrementQuantity(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId)
      if (menuIndex !== -1) {
        this.cart[menuIndex].quantity += 1
      }
    },
    decrementQuantity(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId)
      if (menuIndex !== -1) {
        this.cart[menuIndex].quantity -= 1
        if (this.cart[menuIndex].quantity === 1) {
          this.removeMenuFromCart(MenuId)
        }
      }
    },
  },
  persist: true
})
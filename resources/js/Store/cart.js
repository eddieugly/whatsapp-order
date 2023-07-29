import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  
  state: () => ({ cart: [] }),
  actions: {
    removeMenuFromCart(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId);
      this.cart.splice(menuIndex, 1);
    },
    increaseQuantity(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId);
      if (menuIndex !== -1) {
        this.cart[menuIndex].quantity += 1;
      }
    },
    decreaseQuantity(MenuId) {
      const menuIndex = this.cart.findIndex((menu) => menu.id === MenuId);
      if (menuIndex !== -1) {
        if (this.cart[menuIndex].quantity === 1) {
          this.removeMenuFromCart(MenuId);
        }
        this.cart[menuIndex].quantity -= 1;
      }
    },
  },
  persist: true
})
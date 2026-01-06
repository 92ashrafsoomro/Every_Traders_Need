<template>

  <div class=" w-100 h-100 bg-surface   pb-8" style="position: absolute;">
    <div class="pattern-bg"></div>
    <div class="position-relative  pt-5  " style=" max-width: 1400px; z-index: 10">
      <slot> </slot>
    </div>
    <div class="page-404">
      <h1>404</h1>
      <canvas ref="game" width="600" height="200"></canvas>
      <p v-if="gameOver" class="game-over">
        Game Over – Click to Try Again
      </p>
    </div>
  </div>
</template>

<script>
import carImg from '@/assets/images/logo/typre.gif'
import stone from '@/assets/images/logo/stone.png'
export default {
  data() {
    return {
      ctx: null,
      car: { x: 50, y: 50, vy: 10 },
      block: { x: 610, y: 150 },
      gravity: 0.6,
      jumping: false,
      gameOver: false,
      carImage: null,
      blockImage: null
    }
  },

  mounted() {
    const canvas = this.$refs.game
    this.ctx = canvas.getContext("2d")

    canvas.addEventListener("click", this.jump)
    window.addEventListener("keydown", e => {
      if (e.code === "Space") this.jump()
    })
    this.carImage = new Image()

    this.carImage.src = carImg

    this.blockImage = new Image()
    this.blockImage.src = stone

    Promise.all([
      new Promise(resolve => this.carImage.onload = resolve),
      new Promise(resolve => this.blockImage.onload = resolve)
    ]).then(() => {
      this.loop()
    })
  },

  methods: {
    jump() {
      if (!this.jumping && !this.gameOver) {
        this.car.vy = -11
        this.jumping = true
      }
      if (this.gameOver) location.reload()
    },

    loop() {
      if (this.gameOver) return

      this.ctx.fillStyle = ""
      this.ctx.fillRect(0, 0, 600, 200)

      this.car.y += this.car.vy
      this.car.vy += this.gravity

      if (this.car.y >= 150) {
        this.car.y = 150
        this.jumping = false
      }

      this.block.x -= 4
      if (this.block.x < -60) this.block.x = 600

      if (
        this.block.x < this.car.x + 50 &&
        this.block.x + 50 > this.car.x &&
        this.car.y + 30 > this.block.y
      ) {
        this.gameOver = true
      }

      this.ctx.drawImage(this.carImage, this.car.x - 20, this.car.y - 30, 80, 50)

      this.ctx.drawImage(this.blockImage, this.block.x - 10, this.block.y - 30, 40, 40)  // Ab stone bahut chota dikhega

      requestAnimationFrame(this.loop)
    }
  }
}
</script>

<style>
.game-center {
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 20;
}

.page-404 {
  text-align: center;
}

canvas {
  /* background-color: rgb(var(--v-theme-surface)) !important; */
  border-radius: 10px;
  border: 2px solid #ddd;
}

.game-over {
  margin-top: 12px;
  font-weight: 600;
}
</style>
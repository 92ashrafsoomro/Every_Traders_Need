<template>
  <!-- AAPKA EXISTING BG (NO CHANGE) -->
  <div class="w-100 h-100 bg-surface pb-8" style="position: absolute;">
    <div class="pattern-bg"></div>

    <div class="game-center  position-relative">
      
      <div class="page-404">
      <h1>404</h1>
        <canvas ref="game" width="600" height="200" ></canvas>
        <p v-if="gameOver" class="game-over">
          Game Over – Click to Try Again
        </p>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      ctx: null,
      car: { x: 50, y: 150, vy: 0 },
      block: { x: 600, y: 150 },
      gravity: 0.6,
      jumping: false,
      gameOver: false,
    }
  },

  mounted() {
    const canvas = this.$refs.game
    this.ctx = canvas.getContext("2d")

    canvas.addEventListener("click", this.jump)
    window.addEventListener("keydown", e => {
      if (e.code === "Space") this.jump()
    })

    this.loop()
  },

  methods: {
    jump() {
      if (!this.jumping && !this.gameOver) {
        this.car.vy = -10
        this.jumping = true
      }

      if (this.gameOver) location.reload()
    },

    loop() {
      if (this.gameOver) return

      // Canvas white (ONLY GAME)
      this.ctx.fillStyle = "#ffffff"
      this.ctx.fillRect(0, 0, 600, 200)

      // Physics
      this.car.y += this.car.vy
      this.car.vy += this.gravity

      if (this.car.y >= 150) {
        this.car.y = 150
        this.jumping = false
      }

      // Block movement
      this.block.x -= 4
      if (this.block.x < -20) this.block.x = 600

      // Collision
      if (
        this.block.x < this.car.x + 30 &&
        this.block.x + 20 > this.car.x &&
        this.car.y + 20 > this.block.y
      ) {
        this.gameOver = true
      }

      // Draw car & block
      this.ctx.fillStyle = "#000"
      this.ctx.fillRect(this.car.x, this.car.y, 30, 20)
      this.ctx.fillRect(this.block.x, this.block.y, 20, 20)

      requestAnimationFrame(this.loop)
    }
  }
}
</script>

<style>
.game-center {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 20;  background-color: rgb(var(--v-theme-surface)) !important; 
}

.page-404 {
  text-align: center;
}

canvas {
  background-color: rgb(var(--v-theme-surface)) !important;      
  border-radius: 10px;
  border: 2px solid #ddd;
}

.game-over {
  margin-top: 12px;
  font-weight: 600;
}

</style>

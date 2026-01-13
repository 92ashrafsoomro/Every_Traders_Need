<template>  

  <div class="w-100 h-100 bg-surface pb-8" style="position: absolute;">
    <div class="pattern-bg"></div>
    <div class="position-relative pt-5" style="max-width: 1400px; z-index: 10">
      <slot />
    </div>
  </div>
  <v-container
    fluid
    class="bg-surface d-flex align-center justify-center"
    style="min-height: 100vh;"
  >

    <div style="max-width: 900px;" class="mx-auto w-100">
      <v-row align="center" justify="center">
        <v-col cols="12" md="8">
          <v-card
            class="pa-8 rounded-xl border"
            elevation="0"
          >
            <v-row align="center">
            
              <v-col cols="12" md="6">
                <h1
                  class="text-h1 font-weight-bold text-primary"
                  style="line-height: 1;"
                >
                  404
                </h1>

                <h3 class="text-h5 mt-2">
                  Page not found
                </h3>

                <p class="text-body-2 text-medium-emphasis mt-3">
                  The page you’re looking for doesn’t exist or has been moved.
                  Please check the URL or return to the dashboard.
                </p>

                <div class="mt-6 d-flex ga-3">
                  <v-btn
                    color="primary"
                    variant="flat"
                  >
                   <router-link to="/autoboli" style="text-decoration: none; color: white;"> Go Back</router-link>
                  </v-btn>


                </div>
              </v-col>

    
              <v-col cols="12" md="6" class="text-center">
             <img :src="logo" alt="" srcset="" sizes="cover">
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>

</template>

<script>
import logo from "@/assets/images/logo/logo.png"
export default {
    data(){
        return{
           
            logo
        }
    }
}
</script>



<style scoped>
.fill-height {
    min-height: 100vh;
    background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
}

.v-card {
    transition: all 0.3s ease;
}

.v-btn {
    transition: transform 0.2s ease;
}

.v-btn:hover {
    transform: translateY(-2px);
}

svg {
    max-width: 100%;
    height: auto;
}
</style>
<!-- <template>

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
</style> -->
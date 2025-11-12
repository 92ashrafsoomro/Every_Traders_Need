<template>
  <div class="table-wrapper">
    <v-table>
      <thead>
        <tr>
          <!-- Sticky left column -->
          <th class="sticky-left text-left bg-surface position-sticky left-0" style="z-index: 10;"></th>

          <!-- Dynamic columns -->
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
          <th class="pa-3" >
            <div class="d-flex flex-column justify-center align-center"
              style="height: 300px; background-color: #03326a; border-radius: 10px;">
              <div class="border-b  border-secondary pb-1 text-center text-body-1 font-weight-medium w-100">Auction {{ n
                }}</div>
              <img src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/LD23ULM/611671183/600"
                alt="" style="width: 200px; object-fit: cover; padding: 5px; border-radius: 8px;" />
              <h1 class="text-center text-sm text-body-2 font-weight-bold">BMW 1 Series {{ n }}</h1>
              <div class="mt-2 w-100 ps-2 pr-2">
                <p class="text-caption text-left">Other Similar Cars</p>
                <select name="" id="" class="w-100 bg-surface rounded pa-1">
                  <option value="">Select</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                  <option value="One">One</option>
                </select>
              </div>
              <div class="d-flex justify-space-around ga-2 mt-2">
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-danger">Report</button>
                <button class="ps-2 pr-2 pa-1 text-center rounded bg-info">View</button>
              </div>
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Auction Information
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Auction House
          </td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
          <td>Aston Barclay</td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Auction Date
          </td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
          <td>16-10-2025</td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Lot Number
          </td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
          <td>U104CR</td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Sale Status	
          </td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
          <td>Not sold	</td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Final Sold Price/Last Bid	
          </td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
          <td>£4500	</td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Vehicle Spec
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Make
          </td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
          <td>BMW	</td>
       
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Model
          </td>
          <td>1 Series</td>
          <td>1 Series</td>
          <td>1 Series</td>
          <td>1 Series</td>
          <td>1 Series</td>
          <td>1 Series</td>
          <td>1 Series</td>
    
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Variant
          </td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
          <td>116i</td>
    
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Body Type	
          </td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
          <td>Hatchback</td>
 
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Year
          </td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
      
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Engine Size (CC)		
          </td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>
          <td>1.6	</td>

        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Fuel Type		
          </td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
          <td>Petrol</td>
  
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Transmission	
          </td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
          <td>Manual</td>
   
        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Colour	
          </td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>
          <td>N/A	</td>

        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">Market Valuation	
          </td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>
          <td>40%	</td>

        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">CAP Clean Value (£)		
          </td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>

        </tr>
        <tr >
          <!-- Sticky left column -->
          <td class="sticky-left text-no-wrap bg-surface position-sticky left-0" style="z-index: 10;">CAP Average Value (£)		
          </td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>
          <td>1000</td>

        </tr>
      </tbody>
    </v-table>
  </div>
</template>




<script>
export default {
  name: "AuctionTableWithScroll",
  data() {
    return {
    };
  },
};
</script>

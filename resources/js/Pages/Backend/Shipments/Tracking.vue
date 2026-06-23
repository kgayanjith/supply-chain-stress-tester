<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Shipment Location Tracking" subtitle="You can see your shipment current location" />
            <div class="wrapper d-flex justify-content-start">

            </div>
            <div class="mb-5">
                <div id="map" style="height: 500px"></div>
            </div>

        </main>

    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import AppLayout from '@/Layouts/SideNavBar.vue';
import { Link } from '@inertiajs/vue3';
import L from "leaflet";
import "leaflet/dist/leaflet.css";



export default {
    components: {
        HeaderComponent,
        AppLayout,
        Link
    },
    data() {
        return {


        }
    },
    props: {
        shipments: Object,
    },
    mounted() {

        const shipIcon = L.icon({
            iconUrl: '/Images/ship.png',
            iconSize: [40, 40],
            iconAnchor: [20, 20],
            popupAnchor: [0, -20]
        });

        const map = L.map('map').setView(
            [this.shipments.lat, this.shipments.lng],
            8
        );

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution: '&copy; OpenStreetMap'
            }
        ).addTo(map);

        L.marker([
            this.shipments.lat,
            this.shipments.lng
        ], { icon: shipIcon })
            .addTo(map)
            .bindPopup(`
            <b>${this.shipments.ship_name}</b><br>
            MMSI: ${this.shipments.mmsi}<br>
            Destination: ${this.shipments.dest}
        `)
            .openPopup();


    },
    methods: {

    }


}
</script>

<style></style>
<x-dashboard-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 space-y-6">
                <!-- Metric Group One -->
                <x-dashboard::card-metric />
                <!-- Metric Group One -->
            </div>
            <div class="col-span-12">
                <x-dashboard::chart />
                <!-- ====== Chart Two Start -->
                <include src="./partials/chart/chart-02.html" />
                <!-- ====== Chart Two End -->
            </div>

            <div class="col-span-12">
                <!-- ====== Table One Start -->
                <x-dashboard::table-overview />
                <!-- ====== Table One End -->
            </div>
        </div>
    </div>
</x-dashboard-layout>

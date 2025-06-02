@php
$topics = [
"external-inputs" => [
            "title" => "External Inputs (EI)",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">External Inputs (EI)</h2>
                        <p>In Function Point Analysis, <strong>External Inputs (EI)</strong> are data inputs or interactions that come from outside the system and alter its internal state. These inputs can include user-submitted forms, system-triggered data transfers, or inputs from external files or applications. Understanding the complexity of these inputs is critical for accurate project estimation and resource allocation.</p>

                        <p><strong>Example:</strong> Consider a Patient Registration form in a hospital management system. When a patient enters their personal details, medical history, and insurance information, these inputs modify the internal state of the system by creating or updating patient records.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Inputs</h3>
                        <p>The complexity of an EI is evaluated based on two key criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files referenced by the input (such as patient records or insurance databases).</li>
                            <li><strong>Data Element Types (DET):</strong> The unique fields or elements associated with the input (such as name, date of birth, medical history, and insurance ID).</li>
                        </ul>

                        <p>Using these criteria, we can classify the complexity of an EI as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"> </th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-4</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">5-15</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">15+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">3+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once you have determined the complexity level, you can assign FPA points accordingly:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">3</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Understanding how to judge the complexity of External Inputs provides a foundation for accurate FPA, ensuring that the resources allocated to each feature are both justifiable and predictable.</p>
                    HTML
        ],

        "external-outputs" => [
            "title" => "External Outputs (EO)",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">External Outputs (EO)</h2>
                        <p>In Function Point Analysis, <strong>External Outputs (EO)</strong> represent the information generated by the system and presented to users, typically in the form of reports, status updates, or data displays. These outputs do not modify the internal state but deliver critical information based on user interactions or system processes.</p>

                        <p><strong>Example:</strong> In a hospital management system, an "Available Beds Report" provides information about current bed availability across different departments. This report is generated by querying internal databases but does not alter the system's stored data.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Outputs</h3>
                        <p>The complexity of an EO is determined based on two factors:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files or data sources that the output references.</li>
                            <li><strong>Data Element Types (DET):</strong> The unique data elements displayed in the output, such as columns in a report or fields in a data summary.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EO as Low, Average, or High, based on the following table:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-4</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">6-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-3</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">4+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>After determining the complexity level of an EO, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">5</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Determining the complexity of External Outputs allows for a more accurate estimate of the effort required to produce meaningful, user-centric reports and displays. This is a fundamental step in project estimation and resource allocation, ensuring that projects remain efficient and well-planned.</p>
                    HTML
        ],

        "external-inquiries" => [
            "title" => "External Inquiries (EQ)",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">External Inquiries (EQ)</h2>
                        <p>In Function Point Analysis, <strong>External Inquiries (EQ)</strong> represent user-initiated searches or queries that retrieve data without modifying the system's internal state. These inquiries allow users to access specific information based on defined criteria, but they do not alter the data itself.</p>

                        <p><strong>Example:</strong> In a hospital management system, a query to search a patient's appointment history retrieves relevant records but does not change any stored data.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Inquiries</h3>
                        <p>The complexity of an EQ is determined by the following criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files or data tables that the inquiry references to retrieve information.</li>
                            <li><strong>Data Element Types (DET):</strong> The distinct data fields involved in the inquiry, such as patient name, date of appointment, and doctor name in an appointment history search.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EQ as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-3</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">4+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once the complexity level of an EQ is identified, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">3</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Accurately assessing the complexity of External Inquiries allows project estimators to allocate resources effectively, providing insight into both the expected effort and the overall project scope. Mastery of this component in FPA aids in creating realistic project plans and budgets.</p>
                    HTML
        ],

        "internal-logical-files" => [
            "title" => "Internal Logical Files (ILF)",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">Internal Logical Files (ILF)</h2>
                        <p>In Function Point Analysis, <strong>Internal Logical Files (ILF)</strong> are data files that are maintained and managed by the system itself. These files hold essential information that the system frequently updates and processes to support its functions.</p>
                        
                        <p><strong>Example:</strong> In a hospital management system, an ILF could be a database containing all patient records, including personal details, medical history, and current treatments. This information is stored internally and updated as needed.</p>
                        
                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of Internal Logical Files</h3>
                        <p>The complexity of an ILF is determined based on two main criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Record Element Types (RET):</strong> The number of unique record types within the ILF, such as different tables or entities related to patient information.</li>
                            <li><strong>Data Element Types (DET):</strong> The distinct fields or attributes stored within each record, such as patient ID, name, date of birth, and treatment history.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an ILF as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Record Element Types (RET)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Types (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-5</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">6+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once the complexity level of an ILF is determined, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">10</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Understanding the complexity of Internal Logical Files allows project managers to allocate resources effectively and accurately estimate the workload involved in managing essential data within the system.</p>
                    HTML
        ],

        "external-interface-files" => [
            "title" => "External Interface Files (EIF)",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">External Interface Files (EIF)</h2>
                        <p><strong>External Interface Files (EIF)</strong> are data files or tables that the system reads from but does not control. These files are maintained externally, and the system accesses them to retrieve necessary data without altering their content.</p>
                        
                        <p><strong>Example:</strong> In a hospital management system, an EIF might be an external insurance database that the system queries to verify patient insurance details but does not modify.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Interface Files</h3>
                        <p>The complexity of an EIF is assessed based on the following criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Record Element Types (RET):</strong> The distinct record types within the EIF, such as tables or structured data sets related to insurance claims.</li>
                            <li><strong>Data Element Types (DET):</strong> The unique data fields accessed within each record, such as insurance ID, policy status, and coverage details.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EIF as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Record Element Types (RET)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Types (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-5</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">6+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>After determining the complexity level of an EIF, the Function Points (FPA points) are assigned according to the following values:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">5</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Analyzing the complexity of External Interface Files provides insight into the system's dependencies on external data sources and helps in estimating resources required for handling these external files.</p>
                    HTML
        ],

        "total-function-point" => [
            "title" => "Total Function Point (FP) Calculation",
            "content" => <<<HTML
                        <h2 class="text-2xl font-bold mb-4">Calculating the Total Function Point (FP)</h2>
                        <p>After determining the individual function points for each component (EI, EO, EQ, ILF, EIF), the next step is to calculate the <strong>Total Function Point (FP)</strong>. This gives an overall measure of the system’s functional complexity from the user's perspective.</p>

                        <p>The Total FP calculation provides an estimation of the project’s size, which can then be used to predict the development effort, cost, and time required to complete the project.</p>

                        <!-- Calculation Process -->
                        <h3 class="text-xl font-semibold mb-2">Step 1: Sum of Individual Function Points</h3>
                        <p>Start by adding up the points for each component type based on their respective complexities. Use the following breakdown:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>External Inputs (EI):</strong> Total points based on all EI components and their assigned complexity (Low, Average, High).</li>
                            <li><strong>External Outputs (EO):</strong> Total points based on all EO components and their assigned complexity.</li>
                            <li><strong>External Inquiries (EQ):</strong> Total points based on all EQ components and their assigned complexity.</li>
                            <li><strong>Internal Logical Files (ILF):</strong> Total points based on all ILF components and their assigned complexity.</li>
                            <li><strong>External Interface Files (EIF):</strong> Total points based on all EIF components and their assigned complexity.</li>
                        </ul>

                        <p><strong>Formula:</strong> The Total Function Point is calculated by summing up the individual FPA points:</p>
                        
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2">Component</th>
                                        <th class="border border-gray-300 px-4 py-2">Total Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inputs (EI)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EI points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Outputs (EO)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EO points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inquiries (EQ)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EQ points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Internal Logical Files (ILF)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of ILF points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Interface Files (EIF)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EIF points</td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total Function Points (FP)</td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total of all components' points</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Example Calculation -->
                        <h3 class="text-xl font-semibold mb-2">Example Calculation</h3>
                        <p>Let’s assume we have the following components with their respective points:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>EI (External Inputs):</strong> 2 Low (6 points), 1 High (6 points) = 12 points</li>
                            <li><strong>EO (External Outputs):</strong> 1 Low (4 points), 2 Average (10 points) = 14 points</li>
                            <li><strong>EQ (External Inquiries):</strong> 3 Average (12 points) = 12 points</li>
                            <li><strong>ILF (Internal Logical Files):</strong> 1 High (15 points), 1 Low (7 points) = 22 points</li>
                            <li><strong>EIF (External Interface Files):</strong> 1 Average (7 points) = 7 points</li>
                        </ul>
                        
                        <p>Calculating the Total FP:</p>
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2">Component</th>
                                        <th class="border border-gray-300 px-4 py-2">Total Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inputs (EI)</td>
                                        <td class="border border-gray-300 px-4 py-2">12</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Outputs (EO)</td>
                                        <td class="border border-gray-300 px-4 py-2">14</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inquiries (EQ)</td>
                                        <td class="border border-gray-300 px-4 py-2">12</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Internal Logical Files (ILF)</td>
                                        <td class="border border-gray-300 px-4 py-2">22</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Interface Files (EIF)</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total Function Points (FP)</td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold">67</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Adjustments for Project Attributes -->
                        <h3 class="text-xl font-semibold mb-2">Step 2: Applying Complexity and Environmental Factors</h3>
                        <p>The initial FP total can be further refined by incorporating environmental and complexity factors specific to the project, such as:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Performance Requirements:</strong> Projects with high-performance demands may need adjustments.</li>
                            <li><strong>Security Needs:</strong> Systems with stringent security requirements may be more complex.</li>
                            <li><strong>Usability Requirements:</strong> Projects with enhanced usability features may require additional effort.</li>
                        </ul>

                        <p>Typically, a <strong>Value Adjustment Factor (VAF)</strong> is used. This factor ranges from 0.65 to 1.35 based on 14 general system characteristics, resulting in the final adjusted Function Point count:</p>

                        <p class="italic">Adjusted FP = Total FP * VAF</p>

                        <!-- Final Note -->
                        <p class="mt-4">Calculating the Total Function Point count, and applying any necessary adjustments, gives a reliable estimate of project size and complexity. This final FP value becomes an essential input for cost estimation, resource allocation, and project scheduling, enabling informed decision-making for successful project execution.</p>
                    HTML
        ]
]
@endphp
@include('templates.topics', ["topicHeader" => "Function Point Analysis", "placeholderText" => "Select a component to view its contents.", "topics" => $topics])

<script>
    // FPA components data
    const fpaComponents = {
        "external-inputs": {
            "title": "External Inputs (EI)",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">External Inputs (EI)</h2>
                        <p>In Function Point Analysis, <strong>External Inputs (EI)</strong> are data inputs or interactions that come from outside the system and alter its internal state. These inputs can include user-submitted forms, system-triggered data transfers, or inputs from external files or applications. Understanding the complexity of these inputs is critical for accurate project estimation and resource allocation.</p>

                        <p><strong>Example:</strong> Consider a Patient Registration form in a hospital management system. When a patient enters their personal details, medical history, and insurance information, these inputs modify the internal state of the system by creating or updating patient records.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Inputs</h3>
                        <p>The complexity of an EI is evaluated based on two key criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files referenced by the input (such as patient records or insurance databases).</li>
                            <li><strong>Data Element Types (DET):</strong> The unique fields or elements associated with the input (such as name, date of birth, medical history, and insurance ID).</li>
                        </ul>

                        <p>Using these criteria, we can classify the complexity of an EI as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"> </th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-4</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">5-15</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">15+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">3+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once you have determined the complexity level, you can assign FPA points accordingly:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">3</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Understanding how to judge the complexity of External Inputs provides a foundation for accurate FPA, ensuring that the resources allocated to each feature are both justifiable and predictable.</p>
                    `
        },

        "external-outputs": {
            "title": "External Outputs (EO)",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">External Outputs (EO)</h2>
                        <p>In Function Point Analysis, <strong>External Outputs (EO)</strong> represent the information generated by the system and presented to users, typically in the form of reports, status updates, or data displays. These outputs do not modify the internal state but deliver critical information based on user interactions or system processes.</p>

                        <p><strong>Example:</strong> In a hospital management system, an "Available Beds Report" provides information about current bed availability across different departments. This report is generated by querying internal databases but does not alter the system's stored data.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Outputs</h3>
                        <p>The complexity of an EO is determined based on two factors:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files or data sources that the output references.</li>
                            <li><strong>Data Element Types (DET):</strong> The unique data elements displayed in the output, such as columns in a report or fields in a data summary.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EO as Low, Average, or High, based on the following table:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-4</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">6-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-3</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">4+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>After determining the complexity level of an EO, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">5</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Determining the complexity of External Outputs allows for a more accurate estimate of the effort required to produce meaningful, user-centric reports and displays. This is a fundamental step in project estimation and resource allocation, ensuring that projects remain efficient and well-planned.</p>
                    `
        },

        "external-inquiries": {
            "title": "External Inquiries (EQ)",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">External Inquiries (EQ)</h2>
                        <p>In Function Point Analysis, <strong>External Inquiries (EQ)</strong> represent user-initiated searches or queries that retrieve data without modifying the system's internal state. These inquiries allow users to access specific information based on defined criteria, but they do not alter the data itself.</p>

                        <p><strong>Example:</strong> In a hospital management system, a query to search a patient's appointment history retrieves relevant records but does not change any stored data.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Inquiries</h3>
                        <p>The complexity of an EQ is determined by the following criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>File Types Referenced (FTR):</strong> The number of internal or external files or data tables that the inquiry references to retrieve information.</li>
                            <li><strong>Data Element Types (DET):</strong> The distinct data fields involved in the inquiry, such as patient name, date of appointment, and doctor name in an appointment history search.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EQ as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">File Type Referenced (FTR)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Type (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">0-1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-3</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">4+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once the complexity level of an EQ is identified, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">3</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Accurately assessing the complexity of External Inquiries allows project estimators to allocate resources effectively, providing insight into both the expected effort and the overall project scope. Mastery of this component in FPA aids in creating realistic project plans and budgets.</p>
                    `
        },

        "internal-logical-files": {
            "title": "Internal Logical Files (ILF)",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">Internal Logical Files (ILF)</h2>
                        <p>In Function Point Analysis, <strong>Internal Logical Files (ILF)</strong> are data files that are maintained and managed by the system itself. These files hold essential information that the system frequently updates and processes to support its functions.</p>
                        
                        <p><strong>Example:</strong> In a hospital management system, an ILF could be a database containing all patient records, including personal details, medical history, and current treatments. This information is stored internally and updated as needed.</p>
                        
                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of Internal Logical Files</h3>
                        <p>The complexity of an ILF is determined based on two main criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Record Element Types (RET):</strong> The number of unique record types within the ILF, such as different tables or entities related to patient information.</li>
                            <li><strong>Data Element Types (DET):</strong> The distinct fields or attributes stored within each record, such as patient ID, name, date of birth, and treatment history.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an ILF as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Record Element Types (RET)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Types (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-5</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">6+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>Once the complexity level of an ILF is determined, the corresponding Function Points (FPA points) are assigned as follows:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">10</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Understanding the complexity of Internal Logical Files allows project managers to allocate resources effectively and accurately estimate the workload involved in managing essential data within the system.</p>
                    `
        },

        "external-interface-files": {
            "title": "External Interface Files (EIF)",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">External Interface Files (EIF)</h2>
                        <p><strong>External Interface Files (EIF)</strong> are data files or tables that the system reads from but does not control. These files are maintained externally, and the system accesses them to retrieve necessary data without altering their content.</p>
                        
                        <p><strong>Example:</strong> In a hospital management system, an EIF might be an external insurance database that the system queries to verify patient insurance details but does not modify.</p>

                        <!-- Complexity Table with Explanation -->
                        <h3 class="text-xl font-semibold mb-2 mt-4">Determining Complexity of External Interface Files</h3>
                        <p>The complexity of an EIF is assessed based on the following criteria:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Record Element Types (RET):</strong> The distinct record types within the EIF, such as tables or structured data sets related to insurance claims.</li>
                            <li><strong>Data Element Types (DET):</strong> The unique data fields accessed within each record, such as insurance ID, policy status, and coverage details.</li>
                        </ul>

                        <p>Using these criteria, we classify the complexity of an EIF as Low, Average, or High, based on the table below:</p>

                        <!-- Complexity Table -->
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Record Element Types (RET)</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" colspan="3">Data Element Types (DET)</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left"></th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">1-19</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">20-51</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">51+</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">1</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">2-5</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Low</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">6+</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Average</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- FPA Points Explanation -->
                        <h3 class="text-xl font-semibold mb-2">Calculating FPA Points</h3>
                        <p>After determining the complexity level of an EIF, the Function Points (FPA points) are assigned according to the following values:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Complexity</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Low</td>
                                        <td class="border border-gray-300 px-4 py-2">5</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Average</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">High</td>
                                        <td class="border border-gray-300 px-4 py-2">10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Final Instruction -->
                        <p class="mt-4">Analyzing the complexity of External Interface Files provides insight into the system's dependencies on external data sources and helps in estimating resources required for handling these external files.</p>
                    `
        },

        "total-function-point": {
            "title": "Total Function Point (FP) Calculation",
            "content": `
                        <h2 class="text-2xl font-bold mb-4">Calculating the Total Function Point (FP)</h2>
                        <p>After determining the individual function points for each component (EI, EO, EQ, ILF, EIF), the next step is to calculate the <strong>Total Function Point (FP)</strong>. This gives an overall measure of the system’s functional complexity from the user's perspective.</p>

                        <p>The Total FP calculation provides an estimation of the project’s size, which can then be used to predict the development effort, cost, and time required to complete the project.</p>

                        <!-- Calculation Process -->
                        <h3 class="text-xl font-semibold mb-2">Step 1: Sum of Individual Function Points</h3>
                        <p>Start by adding up the points for each component type based on their respective complexities. Use the following breakdown:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>External Inputs (EI):</strong> Total points based on all EI components and their assigned complexity (Low, Average, High).</li>
                            <li><strong>External Outputs (EO):</strong> Total points based on all EO components and their assigned complexity.</li>
                            <li><strong>External Inquiries (EQ):</strong> Total points based on all EQ components and their assigned complexity.</li>
                            <li><strong>Internal Logical Files (ILF):</strong> Total points based on all ILF components and their assigned complexity.</li>
                            <li><strong>External Interface Files (EIF):</strong> Total points based on all EIF components and their assigned complexity.</li>
                        </ul>

                        <p><strong>Formula:</strong> The Total Function Point is calculated by summing up the individual FPA points:</p>
                        
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2">Component</th>
                                        <th class="border border-gray-300 px-4 py-2">Total Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inputs (EI)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EI points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Outputs (EO)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EO points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inquiries (EQ)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EQ points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Internal Logical Files (ILF)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of ILF points</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Interface Files (EIF)</td>
                                        <td class="border border-gray-300 px-4 py-2">Sum of EIF points</td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total Function Points (FP)</td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total of all components' points</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Example Calculation -->
                        <h3 class="text-xl font-semibold mb-2">Example Calculation</h3>
                        <p>Let’s assume we have the following components with their respective points:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>EI (External Inputs):</strong> 2 Low (6 points), 1 High (6 points) = 12 points</li>
                            <li><strong>EO (External Outputs):</strong> 1 Low (4 points), 2 Average (10 points) = 14 points</li>
                            <li><strong>EQ (External Inquiries):</strong> 3 Average (12 points) = 12 points</li>
                            <li><strong>ILF (Internal Logical Files):</strong> 1 High (15 points), 1 Low (7 points) = 22 points</li>
                            <li><strong>EIF (External Interface Files):</strong> 1 Average (7 points) = 7 points</li>
                        </ul>
                        
                        <p>Calculating the Total FP:</p>
                        <div class="overflow-x-auto mb-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2">Component</th>
                                        <th class="border border-gray-300 px-4 py-2">Total Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inputs (EI)</td>
                                        <td class="border border-gray-300 px-4 py-2">12</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Outputs (EO)</td>
                                        <td class="border border-gray-300 px-4 py-2">14</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Inquiries (EQ)</td>
                                        <td class="border border-gray-300 px-4 py-2">12</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Internal Logical Files (ILF)</td>
                                        <td class="border border-gray-300 px-4 py-2">22</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">External Interface Files (EIF)</td>
                                        <td class="border border-gray-300 px-4 py-2">7</td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 font-bold">Total Function Points (FP)</td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold">67</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Adjustments for Project Attributes -->
                        <h3 class="text-xl font-semibold mb-2">Step 2: Applying Complexity and Environmental Factors</h3>
                        <p>The initial FP total can be further refined by incorporating environmental and complexity factors specific to the project, such as:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Performance Requirements:</strong> Projects with high-performance demands may need adjustments.</li>
                            <li><strong>Security Needs:</strong> Systems with stringent security requirements may be more complex.</li>
                            <li><strong>Usability Requirements:</strong> Projects with enhanced usability features may require additional effort.</li>
                        </ul>

                        <p>Typically, a <strong>Value Adjustment Factor (VAF)</strong> is used. This factor ranges from 0.65 to 1.35 based on 14 general system characteristics, resulting in the final adjusted Function Point count:</p>

                        <p class="italic">Adjusted FP = Total FP * VAF</p>

                        <!-- Final Note -->
                        <p class="mt-4">Calculating the Total Function Point count, and applying any necessary adjustments, gives a reliable estimate of project size and complexity. This final FP value becomes an essential input for cost estimation, resource allocation, and project scheduling, enabling informed decision-making for successful project execution.</p>
                    `
        }

    };
    const viewedComponents = {};
    const introComplete = true; // BAD
    let isIntroCompleteSet = false;

    function handleComponentClick(compKey) {
        clickedComponents[compKey] = true;
        localStorage.setItem('clickedComponents', JSON.stringify(clickedComponents));

        document.querySelectorAll('#fpaComponentsList div').forEach(div => {
            div.classList.remove('bg-blue-50');
        });
        event.currentTarget.classList.add('bg-blue-50');

        // Check if all components have been clicked and `introComplete` is not already set
        if (Object.keys(clickedComponents).length === Object.keys(fpaComponents).length && !localStorage.getItem('introComplete')) {
            setIntroComplete();
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        const fpaComponentsList = document.getElementById('fpaComponentsList');
        // Populate FPA components list with click listeners
        Object.entries(fpaComponents).forEach(([key, component]) => {
            const componentElement = document.createElement('div');
            componentElement.className = 'p-4 hover:bg-gray-50 cursor-pointer';
            componentElement.textContent = component.title;
            componentElement.onclick = () => showComponent(key);
            fpaComponentsList.appendChild(componentElement);
        });
    });


    function showComponent(compKey) {
        const contentDiv = document.getElementById('componentContent');
        contentDiv.innerHTML = fpaComponents[compKey].content;

        // Mark the component as viewed
        viewedComponents[compKey] = true;

        // Check if all components have been viewed
        if (Object.keys(viewedComponents).length === Object.keys(fpaComponents).length) {
            setIntroComplete(); // Set intro_complete to true in the backend
        }

        // Highlight the selected component
        document.querySelectorAll('#fpaComponentsList div').forEach(div => {
            div.classList.remove('bg-blue-50');
        });
        event.currentTarget.classList.add('bg-blue-50');
    }


    // Function to set intro_complete to true in the backend
    function setIntroComplete() {
        isIntroCompleteSet = true;
        /*
                            fetch('/labs/cost-estimation/form-update', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        field: 'intro_complete',
                                        value: true
                                    })
                                })
                                .then(response => {
                                    if (response.ok) {
                                        const nextButton = document.getElementById('nextButton');
                                        if (nextButton) {
                                            nextButton.classList.remove('bg-gray-400', 'cursor-not-allowed', 'opacity-50', 'pointer-events-none');
                                            nextButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
                                            nextButton.href = "{{ route('modules.lab', ['lab' => 'cost-estimation', 'subroute' => 'exercise']) }}";
                                        }
                                    } else {
                                        console.error("Failed to set intro_complete");
                                    }
                                });*/
    }
</script>
